<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add Razorpay columns and update payment_status enum
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('razorpay_order_id')->nullable()->after('payment_status');
            $table->string('razorpay_payment_id')->nullable()->after('razorpay_order_id');
        });

        // Modify enum to include 'pending'
        DB::statement("ALTER TABLE enrollments MODIFY payment_status ENUM('pending','paid','unpaid') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert enum change
        DB::statement("ALTER TABLE enrollments MODIFY payment_status ENUM('paid','unpaid') DEFAULT 'unpaid'");

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['razorpay_order_id', 'razorpay_payment_id']);
        });
    }
};
