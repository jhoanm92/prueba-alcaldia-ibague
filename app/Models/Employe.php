<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'identification',
        'sex',
        'birthday',
        'phone',
        'address',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
