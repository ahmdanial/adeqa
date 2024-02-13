<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    protected $fillable = [
        'institution',
        'address',
        'city',
        'state',
        'postalcode',
        'country',
        'contactno',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }
    
    public function lab()
    {
        return $this->hasMany(Lab::class);
    }

    public function instrument()
    {
        return $this->hasMany(Instrument::class);
    }
    public function reagent()
    {
        return $this->hasMany(Reagent::class);
    }

    public function user()    {
        return $this->hasMany(User::class);
    }
}
