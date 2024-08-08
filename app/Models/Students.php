<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Students extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'last_name',
        'middle_initial',
        'first_name',
        'course_id',
        'email',
        'email_verified_at',
        'organization1',
        'organization2',
        'password',
        'org1_member_status',
        'org2_member_status',
        'user_roles',
        'phone_number',
    ];
}
