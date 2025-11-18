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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->foreignId('booth_id')
                ->nullable()
                ->constrained('booths')
                ->onDelete('set null');

            $table->date('rental_start_date');
            $table->date('rental_end_date');

            $table->enum('status', [
                'Pending',
                'Waiting Payment',
                'Processing',
                'Approved',
                'Rejected',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
