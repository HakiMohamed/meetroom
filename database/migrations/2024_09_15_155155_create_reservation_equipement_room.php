<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationEquipementRoomTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_equipement_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->foreignId('equipement_id')->constrained('equipment')->onDelete('cascade');
            $table->timestamps();
        }); 
    }

    public function down()
    {
        Schema::dropIfExists('reservation_equipement');
    }
}
