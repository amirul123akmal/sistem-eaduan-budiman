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