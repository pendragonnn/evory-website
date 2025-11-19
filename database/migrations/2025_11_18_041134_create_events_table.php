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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 200);
            $table->string('location', 255)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('organizer_name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('event_booth_map', 255)->nullable();
            $table->string('cover', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
