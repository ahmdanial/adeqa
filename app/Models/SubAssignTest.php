<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAssignTest extends Model
{
    use HasFactory;

    protected $table = 'subassigntest';

    protected $fillable = [
        'assign_test_id',
        'testcode',
        'method_id',
        'unit_id',
    ];

    public function assignTest()
    {
        return $this->belongsTo(AssignTest::class);
    }

    public function method()
    {
        return $this->belongsTo(Method::class, 'testcode', 'testcode');
    }

    public function test()
    {
        return $this->belongsTo(Test::class, 'testcode');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
