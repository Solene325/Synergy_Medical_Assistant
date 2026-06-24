<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'symptomes' => 'required|string',
        ]);

        $consultation = Consultation::create([
            'patient_id' => Auth::id(),
            'symptomes' => $request->symptomes,
            'statut' => 'en_attente',
            // si le patient a un médecin traitant, on l'assigne automatiquement
            'medecin_id' => Auth::user()->medecin_id,
        ]);

        return redirect()->route('patient.chat')->with('success', 'Consultation créée, un médecin vous répondra bientôt.');
    }
}