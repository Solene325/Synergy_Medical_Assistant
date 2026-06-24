<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    /**
     * Affiche le dossier médical complet.
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer les prescriptions (relation à créer dans User)
        $prescriptions = $user->prescriptionsAsPatient()->latest()->take(10)->get();

        // Récupérer le médecin traitant (si lié par medecin_id)
        $medecinTraitant = null;
        if ($user->medecin_id) {
            $medecinTraitant = User::find($user->medecin_id);
        }

        return view('patient.medical-record', compact('user', 'prescriptions', 'medecinTraitant'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('patient.medical-record-edit', compact('user'));
    }

    /**
     * Met à jour les informations (hors mot de passe).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F,A',
            'groupe_sanguin' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'poids' => 'nullable|numeric|min:1|max:300',
            'taille' => 'nullable|integer|min:50|max:250',
            'allergies' => 'nullable|string|max:500',
            'traitements' => 'nullable|string|max:500',
            'antecedents_personnels' => 'nullable|string|max:500',
            'antecedents_familiaux' => 'nullable|string|max:500',
            'medecin_nom' => 'nullable|string|max:255',
            'medecin_telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'pays' => 'nullable|string|max:100',
            'telephone_urgence' => 'nullable|string|max:20',
            'langue_preferee' => 'nullable|string|max:10',
            'photo_profil' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Gérer la photo de profil
        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo_profil) {
                Storage::disk('public')->delete($user->photo_profil);
            }
            $path = $request->file('photo_profil')->store('photos_profil', 'public');
            $user->photo_profil = $path;
        }

        // Mettre à jour les autres champs
        $user->fill($request->only([
            'prenom', 'nom', 'telephone', 'date_naissance', 'sexe',
            'groupe_sanguin', 'poids', 'taille', 'allergies', 'traitements',
            'antecedents_personnels', 'antecedents_familiaux',
            'medecin_nom', 'medecin_telephone', 'adresse', 'ville',
            'code_postal', 'pays', 'telephone_urgence', 'langue_preferee','photo_profil',
        ]));
        $user->save();

        return redirect()->route('patient.medical-record')
                         ->with('success', 'Vos informations ont été mises à jour.');
    }

    /**
     * Change le mot de passe.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->doit_changer_mdp = false; // si vous utilisez ce flag
        $user->save();

        return redirect()->route('patient.medical-record')
                         ->with('success', 'Mot de passe modifié avec succès.');
    }

    /**
     * Exporte le dossier médical en PDF (nécessite DomPDF).
     */
    public function exportPdf()
    {
        $user = Auth::user();
        $prescriptions = $user->prescriptionsAsPatient()->latest()->get();
        $medecinTraitant = $user->medecin_id ? User::find($user->medecin_id) : null;

        // Si vous avez installé barryvdh/laravel-dompdf
        // $pdf = Pdf::loadView('patient.medical-record.pdf', compact('user', 'prescriptions', 'medecinTraitant'));
        // return $pdf->download('dossier_medical_' . $user->id . '.pdf');

        // Sinon, rediriger avec un message pour l'instant
        return redirect()->back()->with('info', 'L\'export PDF sera disponible prochainement.');
    }
}