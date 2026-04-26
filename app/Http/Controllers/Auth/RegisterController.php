<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    // Afficher l'étape 1
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    // Traiter l'étape 1
    public function postStep1(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|string|max:20',
            'photo_profil' => 'required|image|max:2048',
            'piece_identite' => 'required|image|max:2048',
        ]);

        // Upload des fichiers
        $photoPath = $request->file('photo_profil')->store('photos_profil', 'public');
        $piecePath = $request->file('piece_identite')->store('pieces_identite', 'public');

        // Création de l'utilisateur (sans mot de passe, sans identifiant)
        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'photo_profil' => $photoPath,
            'piece_identite' => $piecePath,
            'role' => 'patient',
            'password' => Hash::make('temp_' . Str::random(20)),
        ]);

        // Stocker l'ID en session pour les étapes suivantes
        Session::put('register_user_id', $user->id);

        // Générer et envoyer le code de vérification
        $this->sendVerificationCode($user);

        return redirect()->route('register.step2');
    }

    // Afficher l'étape 2
    public function showStep2()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step2');
    }

    // Traiter l'étape 2
    public function postStep2(Request $request)
    {
        $request->validate([
            'date_naissance' => 'required|date',
            'poids' => 'required|numeric|min:1|max:300',
            'taille' => 'required|integer|min:50|max:250',
            'groupe_sanguin' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'antecedents_personnels' => 'nullable|string',
            'antecedents_familiaux' => 'nullable|string',
        ]);

        $user = User::findOrFail(Session::get('register_user_id'));
        $user->update($request->only([
            'date_naissance', 'poids', 'taille', 'groupe_sanguin',
            'antecedents_personnels', 'antecedents_familiaux'
        ]));

        return redirect()->route('register.step3');
    }

    // Afficher l'étape 3
    public function showStep3()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step3');
    }

    // Vérifier le code
    public function postStep3(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $userId = Session::get('register_user_id');
        $user = User::findOrFail($userId);

        // Vérifier le code
        $code = VerificationCode::where('user_id', $userId)
                    ->where('code', $request->code)
                    ->where('expires_at', '>', now())
                    ->first();

        if (!$code) {
            return back()->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        // Marquer l'email comme vérifié
        $user->email_verified_at = now();
        $user->save();

        // Supprimer le code
        $code->delete();

        return redirect()->route('register.step4');
    }

    // Afficher l'étape 4 (CGU)
    public function showStep4()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step4');
    }

    // Accepter les politiques et finaliser
    public function postStep4(Request $request)
    {
        $request->validate([
            'accept' => 'required|accepted',
        ]);

        $userId = Session::get('register_user_id');
        $user = User::findOrFail($userId);

        // Enregistrer l'acceptation
        $user->politiques_acceptees_at = now();
        $user->save();

        // Générer un identifiant unique et un mot de passe temporaire
        $identifiant = $this->generateUniqueIdentifier($user);
        $motDePasseTemporaire = Str::random(8); // 8 caractères

        $user->identifiant_unique = $identifiant;
        $user->password = Hash::make($motDePasseTemporaire);
        $user->doit_changer_mdp = true; // forcer le changement à la première connexion
        $user->save();

        // Envoyer les identifiants par email
        $this->sendCredentials($user, $motDePasseTemporaire);

        // Nettoyer la session
        Session::forget('register_user_id');

        // Rediriger vers la page de connexion avec un message
        return redirect()->route('login')->with('success', 'Votre compte a été créé. Vos identifiants vous ont été envoyés par email.');
    }

    // Méthodes privées
    private function sendVerificationCode($user)
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(10);

        VerificationCode::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code, 'expires_at' => $expiresAt]
        );

        // Envoyer l'email
        Mail::send('emails.verification-code', ['code' => $code, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->prenom . ' ' . $user->nom)
                    ->subject('Code de vérification - Synergy Medical Assistant');
        });
    }

    private function generateUniqueIdentifier($user)
    {
        // Format : PAT + année + mois + ID sur 5 chiffres
        $prefix = 'PAT';
        $year = date('y');
        $month = date('m');
        $id = str_pad($user->id, 5, '0', STR_PAD_LEFT);
        return $prefix . $year . $month . $id;
    }

    private function sendCredentials($user, $temporaryPassword)
    {
        Mail::send('emails.credentials', ['user' => $user, 'password' => $temporaryPassword], function ($message) use ($user) {
            $message->to($user->email, $user->prenom . ' ' . $user->nom)
                    ->subject('Bienvenue - Vos identifiants Synergy Medical Assistant');
        });
    }
}