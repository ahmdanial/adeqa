<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $fillable = [
        'testcode',
        'methodname',
        'added_by',
        'update_by',
    ];

     // Relationships

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

