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
    ];

    public function assignTest()
    {
        return $this->belongsTo(AssignTest::class, 'assign_test_id');
    }
}
