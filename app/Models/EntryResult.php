<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryResult extends Model
{
    use HasFactory;

    protected $table = 'entryresults';

    protected $primaryKey = ['entry_id', 'testcode', 'sampledate'];

    public $incrementing = false;

    protected $fillable = [
        'entry_id',
        'testcode',
        'sampledate',
        'result',
        'lab_id',
        'prog_id',
        'instrument_id',
        'reagent_id',
        'method_id',
        'unit_id',
        'added_by',
        'update_by',
    ];

    // Relationships

    public function assignTest()
    {
        return $this->belongsTo(AssignTest::class, 'assign_test_id', 'id');
    }

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
        return $this->belongsToMany(Method::class, 'subassigntest', 'assign_test_id','method_id');
    }

    public function unit()
    {
        return $this->belongsToMany(Unit::class, 'subassigntest', 'assign_test_id','unit_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'subassigntest', 'assign_test_id', 'testcode');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'update_by', 'id');
    }
}
