<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $table = 'instruments';

    protected $fillable = [
        'department_id',
        'instrumentname',
        'added_by',
        'update_by',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function updateBy()
    {
        return $this->belongsTo(User::class, 'update_by', 'id');
    }

    public function reagents()
    {
        return $this->hasMany(Reagent::class);
    }

}
