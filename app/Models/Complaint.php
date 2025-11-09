<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'complaints';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'complaint_type_id',
        'description',
        'image_path',
        'status',
        'admin_comment',
        'public_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'image_path' => 'array',
    ];

    /**
     * Get the image paths as an array.
     * Returns empty array if null or empty.
     */
    public function getImagesAttribute(): array
    {
        return $this->image_path ?? [];
    }

    /**
     * Check if complaint has images.
     */
    public function hasImages(): bool
    {
        return !empty($this->image_path) && is_array($this->image_path) && count($this->image_path) > 0;
    }

    // --- Relationships ---

    /**
     * Get the type of complaint associated with the complaint.
     */
    public function complaintType()
    {
        // Assumes ComplaintType model exists in App\Models
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id');
    }

    /**
     * Get the status logs for the complaint.
     */
    public function statusLogs()
    {
        // Assumes ComplaintStatusLog model exists in App\Models
        return $this->hasMany(ComplaintStatusLog::class, 'complaint_id');
    }

    /**
     * Generate a unique public ID for the complaint.
     * Format: ADU-{TYPE}-{NUMBER}
     * Example: ADU-PRAS-0045
     * 
     * @param int $complaintTypeId
     * @return string
     */
    public static function generatePublicId(int $complaintTypeId): string
    {
        // Get complaint type
        $complaintType = ComplaintType::find($complaintTypeId);
        
        if (!$complaintType) {
            throw new \Exception('Complaint type not found');
        }

        // Get first 4 letters of complaint type name (uppercase)
        $typeCode = strtoupper(substr($complaintType->type_name, 0, 4));
        
        // Pad to 4 characters if shorter
        $typeCode = str_pad($typeCode, 4, 'X', STR_PAD_RIGHT);

        // Get the next running number (globally across all complaints)
        $lastComplaint = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastComplaint ? $lastComplaint->id + 1 : 1;
        
        // Format number as 4-digit with leading zeros
        $number = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Generate public ID
        $publicId = "ADU-{$typeCode}-{$number}";

        // Check if public_id already exists (shouldn't happen, but just in case)
        // Use try-catch to handle cases where column might not exist yet
        try {
            $exists = self::where('public_id', $publicId)->exists();
            if ($exists) {
                // If exists, increment number until unique
                $counter = 1;
                do {
                    $nextNumber = ($lastComplaint ? $lastComplaint->id : 0) + $counter;
                    $number = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                    $publicId = "ADU-{$typeCode}-{$number}";
                    $exists = self::where('public_id', $publicId)->exists();
                    $counter++;
                } while ($exists && $counter < 1000); // Safety limit
            }
        } catch (\Exception $e) {
            // If column doesn't exist yet, just return the generated ID
            // The migration should be run first, but this prevents fatal errors
        }

        return $publicId;
    }

    /**
     * Boot method to auto-generate public_id when creating a complaint.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (empty($complaint->public_id) && !empty($complaint->complaint_type_id)) {
                try {
                    $complaint->public_id = self::generatePublicId($complaint->complaint_type_id);
                } catch (\Exception $e) {
                    // If generation fails, leave it null (migration might not be run yet)
                    // Log the error for debugging
                    logger()->warning('Failed to generate public_id for complaint: ' . $e->getMessage());
                }
            }
        });
    }
}

