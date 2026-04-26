<?php

namespace App\Http\Controllers\Medecin;

use App\Http\Controllers\Controller;
use App\Models\Medicament;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create(User $patient)
    {
        $medicaments = Medicament::all();
        return view('medecin.prescriptions.create', compact('patient', 'medicaments'));
    }

    public function store(Request $request, User $patient)
    {
        $request->validate([
            'medicament_id' => 'required|exists:medicaments,id',
            'posologie' => 'required|string',
            'instructions' => 'nullable|string',
            'duree_jours' => 'nullable|integer|min:1',
            'date_debut' => 'nullable|date',
        ]);

        $data = $request->only(['medicament_id', 'posologie', 'instructions', 'duree_jours', 'date_debut']);
        $data['patient_id'] = $patient->id;
        $data['medecin_id'] = auth()->id();
        $data['statut'] = 'active';

        if ($request->filled('date_debut') && $request->filled('duree_jours')) {
            $data['date_fin'] = \Carbon\Carbon::parse($request->date_debut)->addDays($request->duree_jours);
        }

        Prescription::create($data);

        return redirect()->route('medecin.patients.show', $patient->id)
            ->with('success', 'Prescription ajoutée.');
    }

    public function edit(Prescription $prescription)
    {
        if ($prescription->medecin_id !== auth()->id()) {
            abort(403);
        }
        $medicaments = Medicament::all();
        return view('medecin.prescriptions.edit', compact('prescription', 'medicaments'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'medicament_id' => 'required|exists:medicaments,id',
            'posologie' => 'required|string',
            'instructions' => 'nullable|string',
            'duree_jours' => 'nullable|integer|min:1',
            'date_debut' => 'nullable|date',
            'statut' => 'required|in:active,terminee,annulee',
        ]);

        $data = $request->only(['medicament_id', 'posologie', 'instructions', 'duree_jours', 'date_debut', 'statut']);

        if ($request->filled('date_debut') && $request->filled('duree_jours')) {
            $data['date_fin'] = \Carbon\Carbon::parse($request->date_debut)->addDays($request->duree_jours);
        } else {
            $data['date_fin'] = null;
        }

        $prescription->update($data);

        return redirect()->route('medecin.patients.show', $prescription->patient_id)
            ->with('success', 'Prescription mise à jour.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->back()->with('success', 'Prescription supprimée.');
    }
}