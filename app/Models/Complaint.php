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
        'address',
        'complaint_type_id',
        'description',
        'image_path',
        'status',
        'admin_comment',
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
}

