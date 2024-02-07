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
        'testcode',
        'reagent_id',
        'added_by',
        'update_by',
    ];

     // Relationships

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'prog_id');
    }

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'subassigntest', 'assign_test_id', 'testcode');
    }

    public function subAssignTests()
    {
        return $this->hasMany(SubAssignTest::class, 'assign_test_id');
    }

    public function entryresult()
    {
        return $this->hasMany(EntryResult::class, 'entry_id');
    }

    public function reagent()
    {
        return $this->belongsTo(Method::class, 'reagent_id');
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
