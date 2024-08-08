<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'attendance_id',
        'event_id',
        'organization_name',
        'type_of_activity',
        'student_id',
        'attendance',
    ];
}
