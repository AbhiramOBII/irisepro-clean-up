<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Batch;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First, we need to get challenge and yashodarshi IDs
        $challenges = \App\Challenge::all();
        $yashodarshis = \App\Yashodarshi::all();
        
        if ($challenges->isEmpty() || $yashodarshis->isEmpty()) {
            return; // Skip seeding if required data doesn't exist
        }

        $batches = [
            [
                'title' => 'Leadership Excellence 2025',
                'description' => 'A comprehensive program focused on developing leadership skills and executive presence',
                'challenge_id' => $challenges->first()->id,
                'yashodarshi_id' => $yashodarshis->first()->id,
                'start_date' => now()->addDays(14)->format('Y-m-d'),
                'time' => '09:00:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Technical Innovation Bootcamp',
                'description' => 'Intensive program combining technical aptitude with creative problem-solving approaches',
                'challenge_id' => $challenges->skip(1)->first()->id ?? $challenges->first()->id,
                'yashodarshi_id' => $yashodarshis->skip(1)->first()->id ?? $yashodarshis->first()->id,
                'start_date' => now()->addDays(21)->format('Y-m-d'),
                'time' => '14:00:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Communication Mastery Program',
                'description' => 'Advanced communication skills development for professional and personal growth',
                'challenge_id' => $challenges->skip(2)->first()->id ?? $challenges->first()->id,
                'yashodarshi_id' => $yashodarshis->first()->id,
                'start_date' => now()->addDays(7)->format('Y-m-d'),
                'time' => '10:30:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Entrepreneurship Accelerator',
                'description' => 'Fast-track program for developing entrepreneurial mindset and execution capabilities',
                'challenge_id' => $challenges->skip(3)->first()->id ?? $challenges->first()->id,
                'yashodarshi_id' => $yashodarshis->skip(1)->first()->id ?? $yashodarshis->first()->id,
                'start_date' => now()->addDays(30)->format('Y-m-d'),
                'time' => '16:00:00',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Batch::insert($batches);
    }
}
