<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintStatusLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'complaint_status_logs';

    /**
     * Indicates if the model should be timestamped.
     *
     * We only have 'created_at' in the schema, not 'updated_at'.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'complaint_id',
        'status',
        'updated_by',
        'comment',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // --- Relationships ---

    /**
     * Get the complaint that the status log belongs to.
     */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }

    /**
     * Get the user who updated the status.
     */
    public function updater()
    {
        // Assuming your User model is in App\Models\User
        return $this->belongsTo(User::class, 'updated_by');
    }
}