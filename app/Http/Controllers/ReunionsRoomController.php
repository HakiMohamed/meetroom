<?php

namespace App\Http\Controllers;

use App\Models\ReunionsRoom;

class ReunionsRoomController extends Controller
{
    // Affiche la liste des salles de réunion
    public function index()
    {
        $rooms = ReunionsRoom::all();

        return view('rooms.index', compact('rooms'));
    }

    // Affiche les détails d'une salle de réunion
    public function show(ReunionsRoom $reunionsRoom)
    {
        return view('rooms.show', compact('reunionsRoom'));
    }
}
