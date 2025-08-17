<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitStudentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habit_student_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_id');
            $table->unsignedBigInteger('student_id');
            $table->string('image')->nullable();
            $table->timestamp('datestamp');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('habit_id')->references('id')->on('habits')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            // Indexes for better performance
            $table->index(['student_id', 'datestamp']);
            $table->index(['habit_id', 'datestamp']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habit_student_submissions');
    }
}
