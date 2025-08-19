<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add new values (authorized, refunded) to payment_status enum.
     */
    public function up(): void
    {
        // Note: MySQL requires redefining the whole ENUM list
        DB::statement("ALTER TABLE enrollments MODIFY payment_status ENUM('pending','authorized','paid','refunded','unpaid') DEFAULT 'pending'");
    }

    /**
     * Revert payment_status enum to previous state.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE enrollments MODIFY payment_status ENUM('pending','paid','unpaid') DEFAULT 'pending'");
    }
};
