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
    // Étape 1 : Identité
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'prenom'            => 'required|string|max:255',
            'nom'               => 'required|string|max:255',
            'email'             => 'required|email|unique:users',
            'telephone'         => 'required|string|max:20',
            'photo_profil'      => 'required|file|mimes:png,jpg,jpeg,webp,pdf|max:5120',
            'piece_identite'    => 'required|file|mimes:png,jpg,jpeg,webp,pdf|max:5120',
        ]);

        $photoPath = $request->file('photo_profil')->store('photos_profil', 'public');
        $piecePath = $request->file('piece_identite')->store('pieces_identite', 'public');

        $user = User::create([
            'prenom'          => $request->prenom,
            'nom'             => $request->nom,
            'email'           => $request->email,
            'telephone'       => $request->telephone,
            'photo_profil'    => $photoPath,
            'piece_identite'  => $piecePath,
            'role'            => 'patient',
            'password'        => Hash::make('temp_' . Str::random(20)),
            'langue_preferee' => 'fr', // temporaire, sera mis à jour à l'étape 4
        ]);

        Session::put('register_user_id', $user->id);

        $this->sendVerificationCode($user);

        return redirect()->route('register.step2');
    }

    // Étape 2 : Données médicales
    public function showStep2()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step2');
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'date_naissance'          => 'required|date',
            'sexe'                    => 'required|in:M,F,A',
            'poids'                   => 'required|numeric|min:1|max:300',
            'taille'                  => 'required|integer|min:50|max:250',
            'sexe'                    => 'required|in:M,F,A',
            'groupe_sanguin'          => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'allergies'               => 'nullable|string',
            'traitements'             => 'nullable|string',
            'antecedents_personnels'  => 'nullable|string',
            'antecedents_familiaux'   => 'nullable|string',
            'medecin_nom'             => 'nullable|string|max:255',
            'medecin_telephone'       => 'nullable|string|max:20',
            'piece_medicale'          => 'nullable|file|mimes:png,jpg,jpeg,webp,pdf|max:5120',
        ]);

        $user = User::findOrFail(Session::get('register_user_id'));

        $data = $request->only([
            'date_naissance', 'sexe', 'poids', 'taille','sexe' ,'groupe_sanguin',
            'allergies', 'traitements', 'antecedents_personnels',
            'antecedents_familiaux', 'medecin_nom', 'medecin_telephone'
        ]);

        if ($request->hasFile('piece_medicale')) {
            $path = $request->file('piece_medicale')->store('pieces_medicales', 'public');
            $data['piece_medicale'] = $path;
        }

        $user->update($data);

        return redirect()->route('register.step3');
    }

    // Étape 3 : Vérification du code
    public function showStep3()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step3');
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $userId = Session::get('register_user_id');
        $user = User::findOrFail($userId);

        $code = VerificationCode::where('user_id', $userId)
                    ->where('code', $request->code)
                    ->where('expires_at', '>', now())
                    ->first();

        if (!$code) {
            return back()->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        $user->email_verified_at = now();
        $user->save();
        $code->delete();

        return redirect()->route('register.step4');
    }

    // Gestion du renvoi du code de vérification 
    public function resendCode(Request $request)
    {
        // Vérifier que l'utilisateur est en cours d'inscription
        if (!Session::has('register_user_id')) {
            return response()->json(['error' => 'Session invalide.'], 400);
        }

        $userId = Session::get('register_user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur introuvable.'], 404);
        }

        // Générer un nouveau code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(10);

        // Mettre à jour ou créer le code
        VerificationCode::updateOrCreate(
            ['user_id' => $userId],
            ['code' => $code, 'expires_at' => $expiresAt]
        );

        // Envoyer l'email
        Mail::send('emails.verification-code', ['code' => $code, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->prenom . ' ' . $user->nom)
                    ->subject('Nouveau code de vérification - Synergy Medical Assistant');
        });

        return response()->json(['success' => 'Un nouveau code vous a été envoyé par email.']);
    }

    // Étape 4 : Localisation
    public function showStep4()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step4');
    }

    public function postStep4(Request $request)
    {
        $request->validate([
            'adresse'          => 'nullable|string|max:500',
            'adresse_rue'      => 'nullable|string|max:255',
            'ville'            => 'nullable|string|max:255',
            'code_postal'      => 'nullable|string|max:20',
            'pays'             => 'nullable|string|max:100',
            'latitude'         => 'nullable|numeric|between:-90,90',
            'longitude'        => 'nullable|numeric|between:-180,180',
            'telephone_urgence'=> 'nullable|string|max:20',
            'langue_preferee'  => 'required|string|in:fr,en,pt,sw,ha,yo,ig,am,ar',
        ]);

        $user = User::findOrFail(Session::get('register_user_id'));
        $user->update($request->only([
            'adresse', 'adresse_rue', 'ville', 'code_postal', 'pays',
            'latitude', 'longitude', 'telephone_urgence', 'langue_preferee'
        ]));

        return redirect()->route('register.step5');
    }

    // Étape 5 : CGU et finalisation
    public function showStep5()
    {
        if (!Session::has('register_user_id')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register-step5');
    }

    public function postStep5(Request $request)
    {
        $request->validate([
            'accept' => 'required|accepted',
        ]);

        $userId = Session::get('register_user_id');
        $user = User::findOrFail($userId);

        $user->politiques_acceptees_at = now();
        $user->save();

        // Génération de l'identifiant et mot de passe temporaire
        $identifiant = $this->generateUniqueIdentifier($user);
        $motDePasseTemporaire = Str::random(8);

        $user->identifiant_unique = $identifiant;
        $user->password = Hash::make($motDePasseTemporaire);
        $user->doit_changer_mdp = true;
        $user->save();

        $this->sendCredentials($user, $motDePasseTemporaire);

        Session::forget('register_user_id');

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

        Mail::send('emails.verification-code', ['code' => $code, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->prenom . ' ' . $user->nom)
                    ->subject('Code de vérification - Synergy Medical Assistant');
        });
    }

    private function generateUniqueIdentifier($user)
    {
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