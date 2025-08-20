<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Yashodarshi;

class YashodarshiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yashodarshis = [
            [
                'name' => 'Dr. Rajesh Mehta',
                'email' => 'rajesh.mehta@irisepro.com',
                'status' => 'active',
                'biodata' => 'Dr. Rajesh Mehta is a renowned educator with over 15 years of experience in student development and mentorship. He specializes in personality development and leadership training.'
            ],
            [
                'name' => 'Prof. Sunita Devi',
                'email' => 'sunita.devi@irisepro.com',
                'status' => 'active',
                'biodata' => 'Prof. Sunita Devi is an expert in child psychology and educational counseling. She has guided thousands of students in their academic and personal growth journey.'
            ],
            [
                'name' => 'Swami Anandananda',
                'email' => 'swami.anandananda@irisepro.com',
                'status' => 'active',
                'biodata' => 'Swami Anandananda is a spiritual guide and meditation expert. He focuses on inner development, mindfulness, and spiritual growth of young minds.'
            ],
            [
                'name' => 'Dr. Priya Sharma',
                'email' => 'priya.sharma@irisepro.com',
                'status' => 'active',
                'biodata' => 'Dr. Priya Sharma is a life coach and motivational speaker. She specializes in goal setting, time management, and building self-confidence in students.'
            ],
            [
                'name' => 'Acharya Vikash Kumar',
                'email' => 'vikash.kumar@irisepro.com',
                'status' => 'active',
                'biodata' => 'Acharya Vikash Kumar is a traditional teacher with deep knowledge of Indian philosophy and values. He guides students in character building and ethical development.'
            ],
            [
                'name' => 'Ms. Kavita Singh',
                'email' => 'kavita.singh@irisepro.com',
                'status' => 'active',
                'biodata' => 'Ms. Kavita Singh is a career counselor and skill development expert. She helps students discover their potential and choose the right career path.'
            ],
            [
                'name' => 'Dr. Amit Jain',
                'email' => 'amit.jain@irisepro.com',
                'status' => 'inactive',
                'biodata' => 'Dr. Amit Jain is a wellness coach focusing on physical and mental health. He promotes healthy lifestyle habits and stress management techniques.'
            ],
            [
                'name' => 'Guru Ramesh Prasad',
                'email' => 'ramesh.prasad@irisepro.com',
                'status' => 'active',
                'biodata' => 'Guru Ramesh Prasad is a yoga instructor and wellness expert. He teaches students the importance of physical fitness and mental balance.'
            ],
            [
                'name' => 'Dr. Meera Agarwal',
                'email' => 'meera.agarwal@irisepro.com',
                'status' => 'active',
                'biodata' => 'Dr. Meera Agarwal is an academic excellence coach. She helps students develop effective study strategies and overcome learning challenges.'
            ],
            [
                'name' => 'Pandit Suresh Chandra',
                'email' => 'suresh.chandra@irisepro.com',
                'status' => 'active',
                'biodata' => 'Pandit Suresh Chandra is a cultural heritage expert. He teaches students about Indian traditions, values, and the importance of cultural identity.'
            ]
        ];

        foreach ($yashodarshis as $yashodarshi) {
            Yashodarshi::create($yashodarshi);
        }
    }
}
