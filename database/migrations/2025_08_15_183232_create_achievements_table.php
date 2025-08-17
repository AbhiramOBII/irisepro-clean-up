<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->enum('domain', ['attitude', 'aptitude', 'communication', 'execution', 'aace', 'leadership'])->comment('Achievement domain/category');
            $table->string('title', 150)->comment('Achievement title/name');
            $table->integer('threshold')->comment('Threshold value required to unlock this achievement');
            $table->string('image', 500)->nullable()->comment('Image path or URL for the achievement');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['domain', 'threshold']);
            $table->index('threshold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
