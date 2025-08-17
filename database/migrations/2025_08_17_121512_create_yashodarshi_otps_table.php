<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYashodarshiOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yashodarshi_otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yashodarshi_id');
            $table->string('otp', 6);
            $table->timestamp('expires_at');
            $table->boolean('is_used')->default(false);
            $table->timestamps();

            $table->foreign('yashodarshi_id')->references('id')->on('yashodarshis')->onDelete('cascade');
            $table->index(['yashodarshi_id', 'otp']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yashodarshi_otps');
    }
}
