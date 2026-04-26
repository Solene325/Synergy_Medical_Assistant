<?php

namespace App\Http\Controllers\Medecin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $medecin = Auth::user();
        $consultationsEnAttente = $medecin->consultationsAsMedecin()
            ->where('statut', 'en_attente')
            ->count();
        $prescriptionsActives = $medecin->prescriptionsAsMedecin()
            ->where('statut', 'active')
            ->count();
        $patientsUniques = $medecin->prescriptionsAsMedecin()
            ->distinct('patient_id')
            ->count('patient_id');

        return view('medecin.dashboard', compact('consultationsEnAttente', 'prescriptionsActives', 'patientsUniques'));
    }
}