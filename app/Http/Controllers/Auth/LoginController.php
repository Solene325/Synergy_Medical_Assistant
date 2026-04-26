<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifiant_unique' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'identifiant_unique' => $request->identifiant_unique,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Vérifier si l'utilisateur doit changer son mot de passe
            if (Auth::user()->doit_changer_mdp) {
                return redirect()->route('password.change');
            }

            // Redirection selon le rôle
            return $this->redirectToRole();
        }

        return back()->withErrors([
            'identifiant_unique' => 'Ces identifiants ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function redirectToRole()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'medecin':
                return redirect()->route('medecin.dashboard');
            default:
                return redirect()->route('dashboard.patient');
        }
    }
}