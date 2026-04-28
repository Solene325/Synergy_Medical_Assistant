<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Patient\MedecinController;
use App\Http\Controllers\ChatController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Inscription (4 étapes)
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/etape1', [RegisterController::class, 'showStep1'])->name('step1');
    Route::post('/etape1', [RegisterController::class, 'postStep1'])->name('step1.post');
    Route::get('/etape2', [RegisterController::class, 'showStep2'])->name('step2');
    Route::post('/etape2', [RegisterController::class, 'postStep2'])->name('step2.post');
    Route::get('/etape3', [RegisterController::class, 'showStep3'])->name('step3');
    Route::post('/etape3', [RegisterController::class, 'postStep3'])->name('step3.post');
    Route::get('/etape4', [RegisterController::class, 'showStep4'])->name('step4');
    Route::post('/etape4', [RegisterController::class, 'postStep4'])->name('step4.post');
});

// Connexion / Déconnexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Tableaux de bord (protégés)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/patient', [PatientController::class, 'index'])->name('dashboard.patient');
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
});

// traitement du changement de mot de passe
Route::middleware('auth')->get('/password/change', function () {
    return view('auth.change-password');
})->name('password.change');

Route::middleware('auth')->post('/password/change', function (Request $request) {
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
    }

    $user->password = Hash::make($request->password);
    $user->doit_changer_mdp = false;
    $user->save();

    return redirect()->route('dashboard.' . $user->role)->with('success', 'Mot de passe modifié avec succès.');
})->name('password.change.post');

// Routes pour le médecin
Route::middleware(['auth'])->prefix('medecin')->name('medecin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Medecin\DashboardController::class, 'index'])->name('dashboard');

    // Patients
    Route::resource('patients', App\Http\Controllers\Medecin\PatientController::class)->only(['index', 'show']);
    Route::get('patients/{patient}/consultation/{consultation}/diagnose', [App\Http\Controllers\Medecin\PatientController::class, 'diagnoseForm'])->name('patients.diagnose');
    Route::post('patients/consultation/{consultation}/diagnose', [App\Http\Controllers\Medecin\PatientController::class, 'diagnoseStore'])->name('patients.diagnose.store');

    // Prescriptions
    Route::get('patients/{patient}/prescriptions/create', [App\Http\Controllers\Medecin\PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('patients/{patient}/prescriptions', [App\Http\Controllers\Medecin\PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::resource('prescriptions', App\Http\Controllers\Medecin\PrescriptionController::class)->except(['create', 'store', 'index']);

    // Profil
    Route::get('profile', [App\Http\Controllers\Medecin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [App\Http\Controllers\Medecin\ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [App\Http\Controllers\Medecin\ProfileController::class, 'changePasswordForm'])->name('profile.change-password');
    Route::post('profile/change-password', [App\Http\Controllers\Medecin\ProfileController::class, 'changePassword'])->name('profile.change-password');
});

// Routes pour l'administrateur (avec middleware auth et admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    
    // Gestion des utilisateurs
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Gestion des médicaments
    Route::get('/medicaments', [App\Http\Controllers\Admin\AdminController::class, 'medicaments'])->name('medicaments');
    Route::delete('/medicaments/{medicament}', [App\Http\Controllers\Admin\AdminController::class, 'destroyMedicament'])->name('medicaments.destroy');
    
    // Appareil tiers (en développement)
    Route::get('/device-data', [App\Http\Controllers\Admin\AdminController::class, 'deviceData'])->name('device-data');
});

Route::get('/patient/chat', [App\Http\Controllers\Patient\ChatController::class, 'index'])->name('patient.chat');
Route::post('/patient/chat/send', [App\Http\Controllers\Patient\ChatController::class, 'send'])->name('patient.chat.send');

// Routes patient pour voir les médecins
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/medecins', [MedecinController::class, 'index'])->name('medecins.index');
    Route::get('/medecins/{medecin}', [MedecinController::class, 'show'])->name('medecins.show');
});

// Routes de chat (accessible à tous les rôles authentifiés)
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'conversation'])->name('chat.conversation');
    Route::post('/chat/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{user}/new', [ChatController::class, 'getNewMessages'])->name('chat.new');
});