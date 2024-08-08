<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'id',
        'requirement_status',
        //27
        'name',
        'nickname',
        'type_of_organization',
        'academic_course_based',
        'mission',
        'vision',
        'org_email',
        'org_fb',
        'logo',
        'consti_and_byLaws',
        'letter_of_intent',
        'admin_endorsement',
        //Adviser
        'adviser_name',
        'adviser_email',
        //AUSG
        'ausg_rep_studno',
        'ausg_rep_name',
        'ausg_re_email',
        //President
        'president_studno',
        'president_name',
        'president_email',
        //VP Internal
        'vp_internal_studno',
        'vp_internal_name',
        'vp_internal_email',
        //VP External
        'vp_external_studno',
        'vp_external_name',
        'vp_external_email',
        //Secretary
        'secretary_studno',
        'secretary_name',
        'secretary_email',
        //Treasurer
        'treasurer_studno',
        'treasurer_name',
        'treasurer_email',
        //Auditor
        'auditor_studno',
        'auditor_name',
        'auditor_email',
        //Pro
        'pro_studno',
        'pro_name',
        'pro_email',
        'filedBy'

    ];
}
