<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Osa extends Model
{
    use HasFactory;

    protected $table = 'osa';

    protected $fillable = [
        'employee_id',
        'last_name',
        'middle_initial',
        'first_name',
        'email',
        'password',
        'user_role',
        'phone_number',
    ];
}
