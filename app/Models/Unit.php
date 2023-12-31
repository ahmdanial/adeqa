<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'testcode',
        'unit',
        'added_by',
        'update_by',
    ];

    // Relationships
    public function test()
    {
        return $this->belongsTo(Test::class, 'testcode', 'testcode'); // Updated foreign key column name
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
