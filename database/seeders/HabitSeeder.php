<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $habits = [
            [
                'title' => 'Morning Meditation',
                'description' => 'Start your day with 10-15 minutes of mindfulness meditation to center your thoughts and reduce stress.',
                'icon' => 'fas fa-om',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Daily Reading',
                'description' => 'Read for at least 30 minutes daily to expand knowledge and improve focus.',
                'icon' => 'fas fa-book-open',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Physical Exercise',
                'description' => 'Engage in 30-45 minutes of physical activity to maintain health and boost energy.',
                'icon' => 'fas fa-dumbbell',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Gratitude Journal',
                'description' => 'Write down 3 things you are grateful for each day to cultivate positivity.',
                'icon' => 'fas fa-heart',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Skill Learning',
                'description' => 'Dedicate time daily to learning a new skill or improving existing ones.',
                'icon' => 'fas fa-brain',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Healthy Eating',
                'description' => 'Make conscious food choices and maintain a balanced, nutritious diet.',
                'icon' => 'fas fa-apple-alt',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Digital Detox',
                'description' => 'Take regular breaks from screens and social media to improve mental well-being.',
                'icon' => 'fas fa-mobile-alt',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Goal Planning',
                'description' => 'Spend time each day planning and reviewing your short-term and long-term goals.',
                'icon' => 'fas fa-bullseye',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Creative Expression',
                'description' => 'Engage in creative activities like art, music, or writing to stimulate imagination.',
                'icon' => 'fas fa-palette',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Quality Sleep',
                'description' => 'Maintain a consistent sleep schedule with 7-8 hours of quality rest each night.',
                'icon' => 'fas fa-bed',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Social Connection',
                'description' => 'Nurture relationships by spending quality time with family and friends.',
                'icon' => 'fas fa-users',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Nature Time',
                'description' => 'Spend time outdoors in nature to reduce stress and improve mental clarity.',
                'icon' => 'fas fa-tree',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('habits')->insert($habits);
    }
}
