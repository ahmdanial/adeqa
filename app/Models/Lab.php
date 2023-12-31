<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $fillable = [
        'labname',
        'department_id',
        'address',
        'city',
        'state',
        'postalcode',
        'country',
        'contactno',
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
}
