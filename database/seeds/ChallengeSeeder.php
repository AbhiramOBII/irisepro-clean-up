<?php

use Illuminate\Database\Seeder;
use App\Challenge;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $challenges = [
            [
                'title' => '30-Day Mindfulness Challenge',
                'description' => 'Practice mindfulness meditation for 10 minutes daily for 30 consecutive days',
                'features' => 'Daily guided meditations, Progress tracking, Community support, Expert tips',
                'who_is_this_for' => 'Anyone looking to reduce stress, improve focus, and develop mindfulness habits',
                'cost_price' => 50.00,
                'selling_price' => 99.00,
                'special_price' => 79.00,
                'status' => 'active',
                'number_of_tasks' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Logic Puzzle Marathon',
                'description' => 'Solve one complex logic puzzle daily to enhance problem-solving skills',
                'features' => 'Progressive difficulty levels, Solution explanations, Performance analytics, Brain training exercises',
                'who_is_this_for' => 'Students, professionals, and puzzle enthusiasts wanting to sharpen analytical thinking',
                'cost_price' => 30.00,
                'selling_price' => 59.00,
                'special_price' => 45.00,
                'status' => 'active',
                'number_of_tasks' => 21,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Daily Presentation Challenge',
                'description' => 'Create and deliver a 2-minute presentation on different topics each day',
                'features' => 'Topic suggestions, Recording tools, Feedback system, Public speaking tips',
                'who_is_this_for' => 'Professionals, students, and anyone wanting to improve communication skills',
                'cost_price' => 40.00,
                'selling_price' => 79.00,
                'special_price' => 65.00,
                'status' => 'active',
                'number_of_tasks' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Project Sprint Challenge',
                'description' => 'Complete daily project milestones with measurable outcomes',
                'features' => 'Project templates, Progress tracking, Milestone celebrations, Productivity tools',
                'who_is_this_for' => 'Entrepreneurs, project managers, and goal-oriented individuals',
                'cost_price' => 60.00,
                'selling_price' => 119.00,
                'special_price' => 95.00,
                'status' => 'active',
                'number_of_tasks' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Leadership Skills Development',
                'description' => 'Lead a team activity or mentor someone new each day',
                'features' => 'Leadership scenarios, Team building exercises, Mentorship guides, Leadership assessments',
                'who_is_this_for' => 'Emerging leaders, managers, and team leads',
                'cost_price' => 80.00,
                'selling_price' => 149.00,
                'special_price' => 120.00,
                'status' => 'active',
                'number_of_tasks' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Creative Expression Journey',
                'description' => 'Express creativity through different mediums - writing, art, music, etc.',
                'features' => 'Creative prompts, Multi-media tools, Artist community, Creative challenges',
                'who_is_this_for' => 'Artists, writers, musicians, and creative enthusiasts',
                'cost_price' => 35.00,
                'selling_price' => 69.00,
                'special_price' => 55.00,
                'status' => 'draft',
                'number_of_tasks' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Challenge::insert($challenges);
    }
}
