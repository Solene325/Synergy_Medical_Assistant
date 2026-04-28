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
        'date_naissance', 'poids', 'taille', 'groupe_sanguin',
        'antecedents_personnels', 'antecedents_familiaux',
        'password', 'identifiant_unique', 'politiques_acceptees_at',
        'doit_changer_mdp', 'role', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_naissance' => 'date',
            'politiques_acceptees_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

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
}