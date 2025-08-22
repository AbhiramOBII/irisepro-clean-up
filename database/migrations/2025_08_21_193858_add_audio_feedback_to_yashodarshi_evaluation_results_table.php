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
        Schema::table('yashodarshi_evaluation_results', function (Blueprint $table) {
            $table->string('audio_feedback')->nullable()->after('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yashodarshi_evaluation_results', function (Blueprint $table) {
            $table->dropColumn('audio_feedback');
        });
    }
};
