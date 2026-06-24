<?php

namespace App\Http\Controllers\Medecin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
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

    /**
     * Affiche le formulaire de diagnostic pour une consultation donnée.
     * Le paramètre peut être l'ID ou le modèle lui-même.
     */
    public function diagnoseForm($consultation)
    {
        // Si le paramètre est déjà un modèle, on l'utilise ; sinon on le récupère
        if ($consultation instanceof Consultation) {
            $consultationModel = $consultation;
        } else {
            $consultationModel = Consultation::findOrFail($consultation);
        }

        // Vérifier que la consultation appartient au médecin
        if ($consultationModel->medecin_id !== auth()->id()) {
            abort(403);
        }

        return view('medecin.patients.diagnose', compact('consultationModel'));
    }

    /**
     * Enregistre le diagnostic d'une consultation.
     */
    public function diagnoseStore(Request $request, $consultation)
    {
        if ($consultation instanceof Consultation) {
            $consultationModel = $consultation;
        } else {
            $consultationModel = Consultation::findOrFail($consultation);
        }

        // Vérifier que la consultation appartient au médecin
        if ($consultationModel->medecin_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'diagnostic_medecin' => 'required|string',
            'recommandations' => 'nullable|string',
        ]);

        $consultationModel->update([
            'diagnostic_medecin' => $request->diagnostic_medecin,
            'recommandations' => $request->recommandations,
            'statut' => 'traite',
            'medecin_id' => auth()->id(),
        ]);

        return redirect()->route('medecin.patients.show', $consultationModel->patient_id)
            ->with('success', 'Diagnostic enregistré.');
    }

    /**
     * Affiche le résumé IA du patient.
     */
    public function resume($id)
    {
        $patient = User::with(['consultationsAsPatient', 'prescriptionsAsPatient'])->findOrFail($id);
        return view('medecin.patients.resume', compact('patient'));
    }

    /**
     * Assigne un patient au médecin connecté.
     */
    public function assign(Request $request, $id)
    {
        $patient = User::findOrFail($id);
        $patient->medecin_id = auth()->id();
        $patient->save();
        return redirect()->back()->with('success', 'Patient assigné avec succès.');
    }
}