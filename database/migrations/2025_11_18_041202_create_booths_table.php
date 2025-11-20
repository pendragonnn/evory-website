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
        Schema::create('booths', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')
                ->nullable()
                ->constrained('events')
                ->onDelete('set null');

            $table->string('booth_code', 50);
            $table->string('type', 100)->nullable();
            $table->string('size', 50)->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'booked', 'unavailable', 'reserved'])->default('available');

            $table->date('available_start_date');
            $table->date('available_end_date');

            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booths');
    }
};
