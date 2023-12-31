<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lab_id',
        'added_by',
        'update_by',
    ];

     // Relationships

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
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
