<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); // Ensure this matches your model's foreign key
            $table->unsignedBigInteger('user_id');
            $table->enum('meeting_type', ['virtual', 'in-person']);
            $table->string('platform')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('subject')->nullable();
            $table->json('participants')->nullable();
            $table->enum('status', ['finished', 'cancelled', 'encours']);
            $table->timestamps();
        
            $table->foreign('room_id')->references('id')->on('reunions_rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
