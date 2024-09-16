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
            $table->foreignId('RoomId')->constrained('reunions_rooms')->onDelete('cascade');
            $table->foreignId('UserId')->constrained('users')->onDelete('cascade');
            $table->enum('meeting_type', ['virtual', 'in-person']);
            $table->string('platform')->nullable(); // Google Meet, Microsoft Teams, etc.
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('subject')->nullable();
            $table->json('participants')->nullable(); // Liste des participants par email
            $table->enum('status', ['finished', 'cancelled', 'encours']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
