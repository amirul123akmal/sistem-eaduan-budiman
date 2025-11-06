<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaint_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai']);
            $table->foreignId('updated_by')->constrained('users')->onDelete('restrict');
            $table->text('comment')->nullable();
            $table->timestamp('created_at');

            // Indexes for better query performance
            $table->index('complaint_id');
            $table->index('updated_by');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_status_logs');
    }
};

