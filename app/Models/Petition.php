<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $fillable = [
        'id',
        'requirement_status',
        'name',
        'nickname',
        'type_of_organization',
        'academic_course_based',
        'consti_and_byLaws',
        'letter_of_intent',
        'admin_endorsement',
        'signees',
        'adviser_name',
        'adviser_email',
        'president_studno',
        'president_name',
        'president_email',
        'comments'
    ];
}
