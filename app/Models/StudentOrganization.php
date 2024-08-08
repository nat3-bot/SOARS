<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'course',
        'org1',
        'org1_memberstatus',
        'org2',
        'org2_memberstatus',
    ];
}
