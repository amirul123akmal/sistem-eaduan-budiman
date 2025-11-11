<?php

namespace App\Console\Commands;

use App\Models\Complaint;
use App\Models\ComplaintType;
use Illuminate\Console\Command;

class PopulateComplaintPublicIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complaints:populate-public-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate public_id for existing complaints that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to populate public_id for existing complaints...');

        $complaints = Complaint::whereNull('public_id')->orWhere('public_id', '')->get();
        
        if ($complaints->isEmpty()) {
            $this->info('No complaints found without public_id.');
            return 0;
        }

        $bar = $this->output->createProgressBar($complaints->count());
        $bar->start();

        $updated = 0;
        $errors = 0;

        foreach ($complaints as $complaint) {
            try {
                // Get complaint type
                $complaintType = ComplaintType::find($complaint->complaint_type_id);
                
                if (!$complaintType) {
                    $this->newLine();
                    $this->error("Complaint #{$complaint->id} has invalid complaint_type_id: {$complaint->complaint_type_id}");
                    $errors++;
                    $bar->advance();
                    continue;
                }

                // Get first 4 letters of complaint type name (uppercase)
                $typeCode = strtoupper(substr($complaintType->type_name, 0, 4));
                
                // Pad to 4 characters if shorter
                $typeCode = str_pad($typeCode, 4, 'X', STR_PAD_RIGHT);

                // Use complaint ID as the running number
                $number = str_pad($complaint->id, 4, '0', STR_PAD_LEFT);

                // Generate public ID
                $publicId = "ADU-{$typeCode}-{$number}";

                // Check if public_id already exists
                $exists = Complaint::where('public_id', $publicId)
                    ->where('id', '!=', $complaint->id)
                    ->exists();
                
                if ($exists) {
                    // If exists, append complaint ID to make it unique
                    $publicId = "ADU-{$typeCode}-" . str_pad($complaint->id, 4, '0', STR_PAD_LEFT) . "-{$complaint->id}";
                }

                $complaint->public_id = $publicId;
                $complaint->save();

                $updated++;
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Error processing complaint #{$complaint->id}: " . $e->getMessage());
                $errors++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Completed! Updated: {$updated}, Errors: {$errors}");

        return 0;
    }
}
