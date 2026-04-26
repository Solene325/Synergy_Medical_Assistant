<?php

namespace App\Http\Controllers\Medecin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Consultation;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Récupère tous les patients qui ont interagi avec le médecin (via consultations ou prescriptions)
        $medecinId = auth()->id();
        $patients = User::whereHas('consultationsAsPatient', function($q) use ($medecinId) {
            $q->where('medecin_id', $medecinId);
        })->orWhereHas('prescriptionsAsPatient', function($q) use ($medecinId) {
            $q->where('medecin_id', $medecinId);
        })->get();

        return view('medecin.patients.index', compact('patients'));
    }

    public function show(User $patient)
    {
        $medecinId = auth()->id();
        $consultations = Consultation::where('patient_id', $patient->id)
            ->where('medecin_id', $medecinId)
            ->orderBy('created_at', 'desc')
            ->get();
        $prescriptions = $patient->prescriptionsAsPatient()
            ->where('medecin_id', $medecinId)
            ->with('medicament')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecin.patients.show', compact('patient', 'consultations', 'prescriptions'));
    }

    public function diagnoseForm(Consultation $consultation)
    {
        // Vérifier que la consultation appartient au médecin
        if ($consultation->medecin_id !== auth()->id()) {
            abort(403);
        }
        return view('medecin.patients.diagnose', compact('consultation'));
    }

    public function diagnoseStore(Request $request, Consultation $consultation)
    {
        $request->validate([
            'diagnostic_medecin' => 'required|string',
            'recommandations' => 'nullable|string',
        ]);

        $consultation->update([
            'diagnostic_medecin' => $request->diagnostic_medecin,
            'recommandations' => $request->recommandations,
            'statut' => 'traite',
            'medecin_id' => auth()->id(),
        ]);

        return redirect()->route('medecin.patients.show', $consultation->patient_id)
            ->with('success', 'Diagnostic enregistré.');
    }
}