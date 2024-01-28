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
        'department_id',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id'); // Updated foreign key column name
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

}
