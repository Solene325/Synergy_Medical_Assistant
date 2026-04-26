<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medicament;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard admin (statistiques rapides)
    public function index()
    {
        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalMedecins = User::where('role', 'medecin')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalMedicaments = Medicament::count();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalPatients', 'totalMedecins', 
            'totalAdmins', 'totalMedicaments'
        ));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users', compact('users'));
    }

    // Suppression d'un utilisateur
    public function destroyUser(User $user)
    {
        // Empêcher la suppression de son propre compte
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Liste des médicaments
    public function medicaments()
    {
        $medicaments = Medicament::orderBy('nom')->paginate(15);
        return view('admin.medicaments', compact('medicaments'));
    }

    // Suppression d'un médicament
    public function destroyMedicament(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->route('admin.medicaments')->with('success', 'Médicament supprimé avec succès.');
    }

    // Page appareil tiers (placeholder)
    public function deviceData()
    {
        return view('admin.device-data');
    }
}