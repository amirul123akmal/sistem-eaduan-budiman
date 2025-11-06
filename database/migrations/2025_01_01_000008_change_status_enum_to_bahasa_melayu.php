<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing data first (map old values to new values)
        DB::statement("UPDATE complaints SET status = CASE 
            WHEN status = 'pending' THEN 'menunggu'
            WHEN status = 'received' THEN 'diterima'
            WHEN status = 'rejected' THEN 'ditolak'
            WHEN status = 'completed' THEN 'selesai'
        END");

        DB::statement("UPDATE complaint_status_logs SET status = CASE 
            WHEN status = 'pending' THEN 'menunggu'
            WHEN status = 'received' THEN 'diterima'
            WHEN status = 'rejected' THEN 'ditolak'
            WHEN status = 'completed' THEN 'selesai'
        END");

        // Alter complaints table status column
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('menunggu', 'diterima', 'ditolak', 'selesai') DEFAULT 'menunggu'");

        // Alter complaint_status_logs table status column
        DB::statement("ALTER TABLE complaint_status_logs MODIFY COLUMN status ENUM('menunggu', 'diterima', 'ditolak', 'selesai')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Update existing data back to English
        DB::statement("UPDATE complaints SET status = CASE 
            WHEN status = 'menunggu' THEN 'pending'
            WHEN status = 'diterima' THEN 'received'
            WHEN status = 'ditolak' THEN 'rejected'
            WHEN status = 'selesai' THEN 'completed'
        END");

        DB::statement("UPDATE complaint_status_logs SET status = CASE 
            WHEN status = 'menunggu' THEN 'pending'
            WHEN status = 'diterima' THEN 'received'
            WHEN status = 'ditolak' THEN 'rejected'
            WHEN status = 'selesai' THEN 'completed'
        END");

        // Alter back to English ENUM values
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('pending', 'received', 'rejected', 'completed') DEFAULT 'pending'");

        DB::statement("ALTER TABLE complaint_status_logs MODIFY COLUMN status ENUM('pending', 'received', 'rejected', 'completed')");
    }
};

