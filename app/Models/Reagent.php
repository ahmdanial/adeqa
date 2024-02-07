<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    use HasFactory;

    protected $table = 'reagents';

    protected $fillable = [
        'reagent',
        'instrument_id',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
