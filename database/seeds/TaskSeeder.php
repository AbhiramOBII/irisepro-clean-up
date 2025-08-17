<?php

use Illuminate\Database\Seeder;
use App\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'task_title' => 'Daily Reflection Journal',
                'task_description' => 'Write a 200-word reflection on your daily experiences and learnings',
                'task_instructions' => 'Spend 10-15 minutes reflecting on your day. Focus on what you learned, challenges you faced, and how you grew.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Problem Solving Challenge',
                'task_description' => 'Complete a logical reasoning puzzle or mathematical problem',
                'task_instructions' => 'Choose a puzzle that challenges your current skill level. Document your approach and solution process.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Presentation Skills',
                'task_description' => 'Record a 3-minute presentation on a topic of your choice',
                'task_instructions' => 'Select a topic you are passionate about. Practice clear articulation, eye contact, and engaging delivery.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Project Milestone',
                'task_description' => 'Complete a specific milestone in your ongoing project',
                'task_instructions' => 'Define clear deliverables and success criteria. Document your progress and any obstacles encountered.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Team Collaboration',
                'task_description' => 'Lead a team discussion or facilitate a group activity',
                'task_instructions' => 'Practice active listening, encourage participation from all members, and guide the group toward consensus.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Creative Writing',
                'task_description' => 'Write a creative story or poem expressing your thoughts',
                'task_instructions' => 'Let your imagination flow. Focus on authentic expression rather than perfect grammar or structure.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Data Analysis',
                'task_description' => 'Analyze a dataset and present insights with visualizations',
                'task_instructions' => 'Use appropriate tools to explore data patterns. Create clear visualizations that tell a compelling story.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task_title' => 'Public Speaking',
                'task_description' => 'Deliver a speech to an audience on a relevant topic',
                'task_instructions' => 'Structure your speech with clear introduction, body, and conclusion. Practice beforehand and engage with your audience.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Task::insert($tasks);
    }
}
