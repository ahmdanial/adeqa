<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignInstrument extends Model
{
    use HasFactory;

    protected $table = 'assign_instruments';

    protected $fillable = [
        'institution_id',
        'instrument_id',
        'instrumentname',
        'added_by',
        'update_by'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function reagents()
    {
        return $this->hasMany(Reagent::class, 'instrument_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

}
