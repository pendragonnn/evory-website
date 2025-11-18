<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->nullable()
                ->unique()
                ->constrained('bookings')
                ->onDelete('set null');

            $table->enum('payment_method', ['Bank Transfer'])->default('Bank Transfer');

            $table->enum('payment_status', [
                'Unpaid',
                'Waiting Verification',
                'Paid',
                'Rejected'
            ])->default('Unpaid');

            $table->string('payment_proof', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
