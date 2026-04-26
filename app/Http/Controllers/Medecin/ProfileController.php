<?php

namespace App\Http\Controllers\Medecin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('medecin.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'photo_profil' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['prenom', 'nom', 'email', 'telephone']);

        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo si existe
            if ($user->photo_profil) {
                Storage::disk('public')->delete($user->photo_profil);
            }
            $data['photo_profil'] = $request->file('photo_profil')->store('photos_profil', 'public');
        }

        $user->update($data);

        return redirect()->route('medecin.profile.edit')->with('success', 'Profil mis à jour.');
    }

    public function changePasswordForm()
    {
        return view('medecin.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->doit_changer_mdp = false;
        $user->save();

        return redirect()->route('medecin.profile.edit')->with('success', 'Mot de passe modifié.');
    }
}