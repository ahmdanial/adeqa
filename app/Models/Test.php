<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $casts = [
        'testcode' => 'string',
    ];

    protected $primaryKey = 'testcode'; // Define the primary key field

    protected $fillable = [
        'testcode',
        'testname',
        'reagent_id',
        'method_id',
        'unit_id',
        'expected_result',
        'low_range',
        'high_range',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function reagent()
    {
        return $this->belongsTo(Reagent::class, 'reagent_id'); // Updated foreign key column name
    }

    public function method()
    {
        return $this->belongsTo(Method::class, 'method_id'); // Updated foreign key column name
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id'); // Updated foreign key column name
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by');
    }

    public function assignTests()
    {
        return $this->belongsToMany(AssignTest::class, 'subassigntest', 'testcode', 'assign_test_id');
    }

    public function subAssignTests()
    {
        return $this->hasMany(SubAssignTest::class);
    }

}
