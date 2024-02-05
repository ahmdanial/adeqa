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
        'unit_id',
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
     public function unit()
        {
            return $this->belongsTo(Unit::class, 'unit_id');
        }

    public function subassigntest()
        {
            return $this->hasOne(Subassigntest::class, 'testcode', 'testcode');
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
