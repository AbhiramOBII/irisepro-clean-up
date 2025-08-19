<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email_id');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'prefer_not_to_say']);
            $table->string('educational_level')->nullable();
            $table->text('goals')->nullable();
            $table->unsignedBigInteger('batch_selected');
            $table->unsignedBigInteger('challenge_id');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('batch_selected')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
