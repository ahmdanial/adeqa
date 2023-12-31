<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    use HasFactory;
    protected $fillable = [
        'reagent',
        'instrument_id',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id'); // Updated foreign key column name
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
