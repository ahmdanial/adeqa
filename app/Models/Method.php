<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $fillable = [
        'reagent_id',
        'testcode',
        'methodname',
        'added_by',
        'update_by',
    ];

     // Relationships

     public function reagent()
     {
         return $this->belongsTo(Reagent::class, 'reagent_id');
     }

     public function test()
     {
         return $this->belongsTo(Test::class, 'testcode', 'testcode');
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
