<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'prenom', 'nom', 'email', 'telephone', 'photo_profil', 'piece_identite',
        'date_naissance', 'poids','sexe','taille', 'groupe_sanguin',
        'antecedents_personnels', 'antecedents_familiaux',
        'adresse', 'adresse_rue', 'ville', 'code_postal', 'pays',
        'latitude', 'longitude', 'telephone_urgence',
        'langue_preferee', 'role', 'identifiant_unique', 'password',
        'doit_changer_mdp', 'email_verified_at', 'politiques_acceptees_at',
        'last_login_at', 'est_actif', 'specialite', 'diplome', 'presentation','medical_summary',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'politiques_acceptees_at' => 'datetime',
        'last_login_at' => 'datetime',
        'date_naissance' => 'date',
        'est_actif' => 'boolean',
        'doit_changer_mdp' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'medical_summary' => 'array',
    ];

    // Relations et autres méthodes (existantes)
    public function verificationCodes()
    {
        return $this->hasMany(VerificationCode::class);
    }

    public function prescriptionsAsPatient()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function prescriptionsAsMedecin()
    {
        return $this->hasMany(Prescription::class, 'medecin_id');
    }

    public function consultationsAsPatient()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }

    public function consultationsAsMedecin()
    {
        return $this->hasMany(Consultation::class, 'medecin_id');
    }

    public function getAgeAttribute()
    {
        return $this->date_naissance?->age;
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('is_read', false);
    }

    public function getSexeLabelAttribute(): string
    {
        return match ($this->sexe) {
            'M' => 'Masculin',
            'F' => 'Féminin',
            'A' => 'Autre',
            default => 'Non renseigné',
        };
    }

    // Accesseur pour l'IMC
    public function getImcAttribute()
    {
        if ($this->poids && $this->taille && $this->taille > 0) {
            return round($this->poids / (($this->taille / 100) ** 2), 1);
     }
        return null;
    }

    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    // Un patient peut avoir un médecin traitant
    public function medecinTraitant()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    // Un médecin a plusieurs patients
    public function patients()
    {
        return $this->hasMany(User::class, 'medecin_id');
    }

}