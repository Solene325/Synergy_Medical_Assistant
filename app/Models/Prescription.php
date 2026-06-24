<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'medecin_id', 'medicament_id', 'posologie',
        'instructions', 'duree_jours', 'date_debut', 'date_fin', 'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }

    public function distributeurCode()
    {
        return $this->hasOne(DistributeurCode::class);
    }
}