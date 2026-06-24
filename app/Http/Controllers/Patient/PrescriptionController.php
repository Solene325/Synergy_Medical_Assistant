<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $prescriptions = $user->prescriptionsAsPatient()->with(['medicament', 'medecin', 'distributeurCode'])->latest()->get();
        return view('patient.prescriptions.index', compact('prescriptions'));
    }

    public function showCode($id)
    {
        $prescription = Auth::user()->prescriptionsAsPatient()->with('distributeurCode')->findOrFail($id);
        $code = $prescription->distributeurCode;
        return view('patient.prescriptions.code', compact('prescription', 'code'));
    }
}