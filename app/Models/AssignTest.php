<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTest extends Model
{
    use HasFactory;

    protected $table = 'assign_test';

    protected $fillable = [
        'lab_id',
        'prog_id',
        'instrument_id',
        'reagent_id',
        'testcode',
        'method_id',
        'unit_id',
        'added_by',
        'update_by',
    ];

     // Relationships

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'prog_id');
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function reagent()
    {
        return $this->belongsTo(Reagent::class, 'reagent_id');
    }

    public function method()
    {
        return $this->belongsTo(Method::class, 'method_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'testcode');
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
