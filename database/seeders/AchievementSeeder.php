<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievements = [
            // Attitude Domain
            ["domain" => "attitude", "title" => "Attitude Spark", "threshold" => 1, "image" => "attitude/Attitude-Spark.webp"],
            ["domain" => "attitude", "title" => "Attitude Stepper", "threshold" => 10, "image" => "attitude/Attitude-Stepper.webp"],
            ["domain" => "attitude", "title" => "Attitude Seeker", "threshold" => 20, "image" => "attitude/Attitude-Seeker.webp"],
            ["domain" => "attitude", "title" => "Attitude Builder", "threshold" => 30, "image" => "attitude/Attitude-Builder.webp"],
            ["domain" => "attitude", "title" => "Attitude Climber", "threshold" => 40, "image" => "attitude/Attitude-Climber.webp"],
            ["domain" => "attitude", "title" => "Attitude Challenger", "threshold" => 50, "image" => "attitude/Attitude-Challenger.webp"],
            ["domain" => "attitude", "title" => "Attitude Achiever", "threshold" => 60, "image" => "attitude/Attitude-Achiever.webp"],
            ["domain" => "attitude", "title" => "Attitude Riser", "threshold" => 70, "image" => "attitude/Attitude-Riser.webp"],
            ["domain" => "attitude", "title" => "Attitude Trailblazer", "threshold" => 80, "image" => "attitude/Attitude-Trailblazer.webp"],
            ["domain" => "attitude", "title" => "Attitude Supreme Transformer", "threshold" => 90, "image" => "attitude/Attitude-Supreme-Transformer.webp"],

            // Aptitude Domain
            ["domain" => "aptitude", "title" => "Aptitude Spark", "threshold" => 1, "image" => "aptitude/Aptitude-Spark.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Stepper", "threshold" => 10, "image" => "aptitude/Aptitude-Stepper.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Seeker", "threshold" => 20, "image" => "aptitude/Aptitude-Seeker.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Builder", "threshold" => 30, "image" => "aptitude/Aptitude-Builder.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Climber", "threshold" => 40, "image" => "aptitude/Aptitude-Climber.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Challenger", "threshold" => 50, "image" => "aptitude/Aptitude-Challenger.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Achiever", "threshold" => 60, "image" => "aptitude/Aptitude-Achiever.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Riser", "threshold" => 70, "image" => "aptitude/Aptitude-Riser.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Trailblazer", "threshold" => 80, "image" => "aptitude/Aptitude-Trailblazer.webp"],
            ["domain" => "aptitude", "title" => "Aptitude Supreme Transformer", "threshold" => 90, "image" => "aptitude/Aptitude-Supreme-Transformer.webp"],

            // Communication Domain
            ["domain" => "communication", "title" => "Communication Spark", "threshold" => 1, "image" => "communication/Communication-Spark.webp"],
            ["domain" => "communication", "title" => "Communication Stepper", "threshold" => 10, "image" => "communication/Communication-Stepper.webp"],
            ["domain" => "communication", "title" => "Communication Seeker", "threshold" => 20, "image" => "communication/Communication-Seeker.webp"],
            ["domain" => "communication", "title" => "Communication Builder", "threshold" => 30, "image" => "communication/Communication-Builder.webp"],
            ["domain" => "communication", "title" => "Communication Climber", "threshold" => 40, "image" => "communication/Communication-Climber.webp"],
            ["domain" => "communication", "title" => "Communication Challenger", "threshold" => 50, "image" => "communication/Communication-Challenger.webp"],
            ["domain" => "communication", "title" => "Communication Achiever", "threshold" => 60, "image" => "communication/Communication-Achiever.webp"],
            ["domain" => "communication", "title" => "Communication Riser", "threshold" => 70, "image" => "communication/Communication-Riser.webp"],
            ["domain" => "communication", "title" => "Communication Trailblazer", "threshold" => 80, "image" => "communication/Communication-Trailblazer.webp"],
            ["domain" => "communication", "title" => "Communication Supreme Transformer", "threshold" => 90, "image" => "communication/Communication-Supreme-Transformer.webp"],

            // Execution Domain
            ["domain" => "execution", "title" => "Execution Spark", "threshold" => 1, "image" => "execution/Execution-Spark.webp"],
            ["domain" => "execution", "title" => "Execution Stepper", "threshold" => 10, "image" => "execution/Execution-Stepper.webp"],
            ["domain" => "execution", "title" => "Execution Seeker", "threshold" => 20, "image" => "execution/Execution-Seeker.webp"],
            ["domain" => "execution", "title" => "Execution Builder", "threshold" => 30, "image" => "execution/Execution-Builder.webp"],
            ["domain" => "execution", "title" => "Execution Climber", "threshold" => 40, "image" => "execution/Execution-Climber.webp"],
            ["domain" => "execution", "title" => "Execution Challenger", "threshold" => 50, "image" => "execution/Execution-Challenger.webp"],
            ["domain" => "execution", "title" => "Execution Achiever", "threshold" => 60, "image" => "execution/Execution-Achiever.webp"],
            ["domain" => "execution", "title" => "Execution Riser", "threshold" => 70, "image" => "execution/Execution-Riser.webp"],
            ["domain" => "execution", "title" => "Execution Trailblazer", "threshold" => 80, "image" => "execution/Execution-Trailblazer.webp"],
            ["domain" => "execution", "title" => "Execution Supreme Transformer", "threshold" => 90, "image" => "execution/Execution-Supreme-Transformer.webp"],

            // AACE Domain
            ["domain" => "aace", "title" => "AACE Spark", "threshold" => 1, "image" => "aace/AACE-Spark.webp"],
            ["domain" => "aace", "title" => "AACE Stepper", "threshold" => 10, "image" => "aace/AACE-Stepper.webp"],
            ["domain" => "aace", "title" => "AACE Seeker", "threshold" => 20, "image" => "aace/AACE-Seeker.webp"],
            ["domain" => "aace", "title" => "AACE Builder", "threshold" => 30, "image" => "aace/AACE-Builder.webp"],
            ["domain" => "aace", "title" => "AACE Climber", "threshold" => 40, "image" => "aace/AACE-Climber.webp"],
            ["domain" => "aace", "title" => "AACE Challenger", "threshold" => 50, "image" => "aace/AACE-Challenger.webp"],
            ["domain" => "aace", "title" => "AACE Achiever", "threshold" => 60, "image" => "aace/AACE-Achiever.webp"],
            ["domain" => "aace", "title" => "AACE Riser", "threshold" => 70, "image" => "aace/AACE-Riser.webp"],
            ["domain" => "aace", "title" => "AACE Trailblazer", "threshold" => 80, "image" => "aace/AACE-Trailblazer.webp"],
            ["domain" => "aace", "title" => "AACE Supreme Transformer", "threshold" => 90, "image" => "aace/AACE-Supreme-Transformer.webp"],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create([
                'domain' => $achievement['domain'],
                'title' => $achievement['title'],
                'threshold' => $achievement['threshold'],
                'image' => $achievement['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
