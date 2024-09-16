<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipmentController extends Controller
{
    // Affiche le formulaire de création d'équipement
    public function create()
    {
        return view('equipments.create');
    }

    // Enregistre un nouvel équipement
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Equipement::create($request->all());

        return redirect()->route('equipments.index')->with('status', 'Equipment created successfully!');
    }

    // Affiche tous les équipements
    public function index()
    {
        $equipments = Equipement::all();
        return view('equipments.index', compact('equipments'));
    }

    // Affiche les détails d'un équipement
    public function show(Equipement $equipment)
    {
        return view('equipments.show', compact('equipment'));
    }

    // Affiche le formulaire d'édition d'équipement
    public function edit(Equipement $equipment)
    {
        return view('equipments.edit', compact('equipment'));
    }

    // Met à jour un équipement
    public function update(Request $request, Equipement $equipment)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $equipment->update($request->all());

        return redirect()->route('equipments.index')->with('status', 'Equipment updated successfully!');
    }

    // Supprime un équipement
    public function destroy(Equipement $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipments.index')->with('status', 'Equipment deleted successfully!');
    }
}
