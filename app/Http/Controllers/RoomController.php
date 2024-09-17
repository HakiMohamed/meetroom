<?php

namespace App\Http\Controllers;

use App\Models\ReunionsRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Affiche le formulaire de création de salle
    public function create()
    {
        return view('rooms.create');
    }

    // Enregistre une nouvelle salle
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer',
            'location' => 'required|string',
        ]);

        ReunionsRoom::create($request->all());

        return redirect()->route('rooms.index')->with('status', 'Room created successfully!');
    }

    // Affiche toutes les salles
    public function index()
    {
        $rooms = ReunionsRoom::paginate(10);

        return view('rooms.index', compact('rooms'));
    }

    // Affiche les détails d'une salle
    public function show(ReunionsRoom $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Affiche le formulaire d'édition de salle
    public function edit(ReunionsRoom $room)
    {
        return view('rooms.edit', compact('room'));
    }

    // Met à jour une salle
    public function update(Request $request, ReunionsRoom $room)
    {
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer',
            'location' => 'required|string',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('status', 'Room updated successfully!');
    }

    // Supprime une salle
    public function destroy(ReunionsRoom $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('status', 'Room deleted successfully!');
    }
}
