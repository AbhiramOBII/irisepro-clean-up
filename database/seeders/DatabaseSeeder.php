<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(SubAttributeSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(YashodarshiSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(ChallengeSeeder::class);
        $this->call(BatchSeeder::class);
        $this->call(TaskScoreSeeder::class);
        $this->call(HabitSeeder::class);
        $this->call(AchievementSeeder::class);
    }
}
