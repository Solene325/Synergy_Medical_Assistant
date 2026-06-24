<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributeurCode extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'code', 'utilise', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'utilise' => 'boolean',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}