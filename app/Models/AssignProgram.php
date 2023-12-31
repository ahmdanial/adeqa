<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'prog_id',
        'lab_id',
        'added_by',
        'update_by',
    ];

     // Relationships

     public function program()
     {
         return $this->belongsTo(Program::class, 'prog_id');
     }

     public function lab()
     {
         return $this->belongsTo(Lab::class, 'lab_id');
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
