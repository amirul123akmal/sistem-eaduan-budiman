<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complaintTypes = [
            [
                'id' => 1,
                'type_name' => 'Prasarana',
                'description' => 'Isu jalan, longkang, lampu jalan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type_name' => 'Kebersihan',
                'description' => 'Isu sampah, perparitan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'type_name' => 'Keselamatan',
                'description' => 'Isu jenayah, pencahayaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'type_name' => 'Lain-lain',
                'description' => 'Aduan umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($complaintTypes as $type) {
            DB::table('complaint_types')->updateOrInsert(
                ['id' => $type['id']],
                $type
            );
        }

        $this->command->info('Complaint types seeded successfully!');
    }
}

