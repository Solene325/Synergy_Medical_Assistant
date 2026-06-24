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

/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Inscription (5 étapes)
|--------------------------------------------------------------------------
*/
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/etape1', [RegisterController::class, 'showStep1'])->name('step1');
    Route::post('/etape1', [RegisterController::class, 'postStep1'])->name('step1.post');
    Route::get('/etape2', [RegisterController::class, 'showStep2'])->name('step2');
    Route::post('/etape2', [RegisterController::class, 'postStep2'])->name('step2.post');
    Route::get('/etape3', [RegisterController::class, 'showStep3'])->name('step3');
    Route::post('/etape3', [RegisterController::class, 'postStep3'])->name('step3.post');
    Route::get('/etape4', [RegisterController::class, 'showStep4'])->name('step4');
    Route::post('/etape4', [RegisterController::class, 'postStep4'])->name('step4.post');
    Route::get('step5', [RegisterController::class, 'showStep5'])->name('step5');
    Route::post('step5', [RegisterController::class, 'postStep5'])->name('step5.post');
    // Renvoi de code de vérification
    Route::post('/resend-code', [RegisterController::class, 'resendCode'])->name('resend');
});

/*
|--------------------------------------------------------------------------
| Connexion / Déconnexion
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Tableaux de bord (protégés)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/patient', [PatientController::class, 'index'])->name('dashboard.patient');
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
});

/*
|--------------------------------------------------------------------------
| Changement de mot de passe (pour tous les utilisateurs authentifiés)
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Routes pour le MÉDECIN
|--------------------------------------------------------------------------
| Toutes les routes du tableau de bord, gestion des patients, prescriptions,
| et profil du médecin.
*/
Route::middleware(['auth'])->prefix('medecin')->name('medecin.')->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [App\Http\Controllers\Medecin\DashboardController::class, 'index'])->name('dashboard');

    // Gestion des patients (index, show, diagnose, assigner, résumé IA)
    Route::resource('patients', App\Http\Controllers\Medecin\PatientController::class)->only(['index', 'show']);
    Route::get('patients/{patient}/consultation/{consultation}/diagnose', [App\Http\Controllers\Medecin\PatientController::class, 'diagnoseForm'])->name('patients.diagnose');
    Route::post('patients/consultation/{consultation}/diagnose', [App\Http\Controllers\Medecin\PatientController::class, 'diagnoseStore'])->name('patients.diagnose.store');
    Route::post('patients/{patient}/assign', [App\Http\Controllers\Medecin\PatientController::class, 'assign'])->name('patients.assign');
    Route::get('patients/{patient}/resume', [App\Http\Controllers\Medecin\PatientController::class, 'resume'])->name('patients.resume');

    // Prescriptions
    Route::get('patients/{patient}/prescriptions/create', [App\Http\Controllers\Medecin\PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('patients/{patient}/prescriptions', [App\Http\Controllers\Medecin\PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::resource('prescriptions', App\Http\Controllers\Medecin\PrescriptionController::class)->except(['create', 'store', 'index']);

    // Profil du médecin
    Route::get('profile', [App\Http\Controllers\Medecin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [App\Http\Controllers\Medecin\ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [App\Http\Controllers\Medecin\ProfileController::class, 'changePasswordForm'])->name('profile.change-password');
    Route::post('profile/change-password', [App\Http\Controllers\Medecin\ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/patients/{patient}/summary', [App\Http\Controllers\Medecin\PatientController::class, 'summary'])->name('patients.summary');
});

/*
|--------------------------------------------------------------------------
| Routes pour l'ADMINISTRATEUR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/medicaments', [App\Http\Controllers\Admin\AdminController::class, 'medicaments'])->name('medicaments');
    Route::delete('/medicaments/{medicament}', [App\Http\Controllers\Admin\AdminController::class, 'destroyMedicament'])->name('medicaments.destroy');
    Route::get('/device-data', [App\Http\Controllers\Admin\AdminController::class, 'deviceData'])->name('device-data');
});

/*
|--------------------------------------------------------------------------
| Routes PATIENT (fonctionnalités spécifiques)
|--------------------------------------------------------------------------
| Chat IA, dossier médical, prescriptions, consultations, liste des médecins
*/
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    // Chat IA médical (assistant santé)
    Route::get('/chat', [App\Http\Controllers\Patient\ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [App\Http\Controllers\Patient\ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/summary', [App\Http\Controllers\Patient\ChatController::class, 'generateSummary'])->name('chat.summary');
    Route::post('/chat/clear', [App\Http\Controllers\Patient\ChatController::class, 'clearHistory'])->name('chat.clear');
    Route::get('/chat/history', [App\Http\Controllers\Patient\ChatController::class, 'getHistory'])->name('chat.history');
    Route::post('/chat/contact', [App\Http\Controllers\Patient\ChatController::class, 'contactDoctor'])->name('chat.contact');

    // Dossier médical
    Route::get('/medical-record', [App\Http\Controllers\Patient\MedicalRecordController::class, 'index'])->name('medical-record');
    Route::get('/medical-record/edit', [App\Http\Controllers\Patient\MedicalRecordController::class, 'edit'])->name('medical-record.edit');
    Route::put('/medical-record', [App\Http\Controllers\Patient\MedicalRecordController::class, 'update'])->name('medical-record.update');
    Route::post('/medical-record/change-password', [App\Http\Controllers\Patient\MedicalRecordController::class, 'changePassword'])->name('medical-record.change-password');
    Route::get('/medical-record/export-pdf', [App\Http\Controllers\Patient\MedicalRecordController::class, 'exportPdf'])->name('medical-record.export-pdf');

    // Prescriptions reçues
    Route::get('/prescriptions', [App\Http\Controllers\Patient\PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/{prescription}/code', [App\Http\Controllers\Patient\PrescriptionController::class, 'showCode'])->name('prescriptions.code');

    // Création d'une consultation (depuis le chat IA)
    Route::post('/consultations', [App\Http\Controllers\Patient\ConsultationController::class, 'store'])->name('consultations.store');

    // Liste des médecins
    Route::get('/medecins', [MedecinController::class, 'index'])->name('medecins.index');
    Route::get('/medecins/{medecin}', [MedecinController::class, 'show'])->name('medecins.show');
});

/*
|--------------------------------------------------------------------------
| ROUTES DE CHAT (Médecin ↔ Patient)
|--------------------------------------------------------------------------
| Accessibles à tous les utilisateurs authentifiés (médecins et patients).
| Permet la messagerie, les diagnostics, les prescriptions, la vidéo.
*/
Route::middleware('auth')->group(function () {

    // --- Messagerie ---
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'conversation'])->name('chat.conversation');
    Route::post('/chat/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{user}/new', [ChatController::class, 'getNewMessages'])->name('chat.new');

    // --- Actions médicales (uniquement pour les médecins, mais on vérifiera dans le contrôleur) ---
    Route::post('/chat/{user}/diagnose', [ChatController::class, 'storeDiagnosis'])->name('chat.diagnose');
    Route::post('/chat/{user}/prescribe', [ChatController::class, 'storePrescription'])->name('chat.prescribe');

    // --- Demande de consultation (par le patient) ---
    Route::post('/chat/{user}/request-consultation', [ChatController::class, 'requestConsultation'])->name('chat.request-consultation');

    // --- Appel vidéo ---
    Route::get('/chat/{user}/video', [ChatController::class, 'videoCall'])->name('chat.video');
});