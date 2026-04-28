<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'medecin');
        
        if ($request->filled('specialite')) {
            $query->where('specialite', 'like', '%' . $request->specialite . '%');
        }
        
        $medecins = $query->paginate(12);
        $specialites = User::where('role', 'medecin')
                           ->whereNotNull('specialite')
                           ->distinct()
                           ->pluck('specialite');
        
        return view('patient.medecins.index', compact('medecins', 'specialites'));
    }
    
    public function show(User $medecin)
    {
        if ($medecin->role !== 'medecin') {
            abort(404);
        }
        return view('patient.medecins.show', compact('medecin'));
    }
}