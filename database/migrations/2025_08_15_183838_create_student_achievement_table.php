<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAchievementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_achievement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('Reference to students table');
            $table->unsignedBigInteger('achievement_id')->comment('Reference to optimized_achievements table');
            $table->datetime('unlocked_at')->comment('When the achievement was unlocked');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate achievements
            $table->unique(['student_id', 'achievement_id'], 'student_achievement_unique');
            
            // Indexes for performance
            $table->index(['student_id', 'unlocked_at']);
            $table->index(['achievement_id', 'unlocked_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_achievement');
    }
}
