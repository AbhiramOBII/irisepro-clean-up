<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYashodarshiEvaluationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yashodarshi_evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('challenge_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('yashodarshi_id');
            $table->json('attribute_scores'); // JSON to store all evaluation details
            $table->decimal('aptitude_score', 5, 2)->default(0);
            $table->decimal('attitude_score', 5, 2)->default(0);
            $table->decimal('communication_score', 5, 2)->default(0);
            $table->decimal('execution_score', 5, 2)->default(0);
            $table->decimal('total_score', 6, 2)->default(0);
            $table->text('feedback')->nullable();
            $table->enum('status', ['draft', 'submitted', 'reviewed'])->default('draft');
            $table->timestamp('evaluated_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('yashodarshi_id')->references('id')->on('yashodarshis')->onDelete('cascade');

            // Unique constraint to prevent duplicate evaluations
            $table->unique(['batch_id', 'task_id', 'student_id', 'yashodarshi_id'], 'unique_evaluation');

            // Indexes for better query performance
            $table->index(['batch_id', 'task_id']);
            $table->index(['student_id', 'yashodarshi_id']);
            $table->index('status');
            $table->index('evaluated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yashodarshi_evaluation_results');
    }
}
