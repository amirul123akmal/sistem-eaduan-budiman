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
        // Convert existing single image_path to JSON array format
        // First, change column to TEXT to allow JSON string storage
        Schema::table('complaints', function (Blueprint $table) {
            $table->text('image_path')->nullable()->change();
        });
        
        // Convert data to JSON array format
        $complaints = DB::table('complaints')->whereNotNull('image_path')->where('image_path', '!=', '')->get();
        foreach ($complaints as $complaint) {
            // Check if already JSON, if not convert to array
            $decoded = json_decode($complaint->image_path, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                // It's a plain string, convert to JSON array
                DB::table('complaints')
                    ->where('id', $complaint->id)
                    ->update(['image_path' => json_encode([$complaint->image_path])]);
            }
        }
        
        // Now change to JSON type
        Schema::table('complaints', function (Blueprint $table) {
            $table->json('image_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert JSON array back to single string (take first image if exists)
        // First change to TEXT to allow string storage
        Schema::table('complaints', function (Blueprint $table) {
            $table->text('image_path')->nullable()->change();
        });
        
        // Convert data back to single string
        $complaints = DB::table('complaints')->whereNotNull('image_path')->get();
        foreach ($complaints as $complaint) {
            $images = json_decode($complaint->image_path, true);
            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
            
            DB::table('complaints')
                ->where('id', $complaint->id)
                ->update(['image_path' => $firstImage]);
        }
        
        // Change back to string type
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('image_path', 255)->nullable()->change();
        });
    }
};
