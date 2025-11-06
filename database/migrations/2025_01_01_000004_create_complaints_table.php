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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone_number', 20);
            $table->text('address');
            $table->foreignId('complaint_type_id')->constrained('complaint_types')->onDelete('restrict');
            $table->text('description');
            $table->string('image_path', 255)->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai'])->default('menunggu');
            $table->text('admin_comment')->nullable();
            $table->timestamps();

            // Indexes for better query performance
            $table->index('status');
            $table->index('complaint_type_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

