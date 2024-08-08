<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsaEvent extends Model
{
    protected $fillable = [
        'id',
        'status',
        'requirement',
        'organization_name',
        'activity_title',
        'type_of_activity',
        'activity_start_datetime',
        'activity_end_datetime',
        'venue',
        'participants',
        'partner_organization',
        'organization_fund',
        'solidarity_share',
        'registration_fee',
        'AUSG_subsidy',
        'sponsored_by',
        'ticket_selling',
        'ticket_control_number',
        'other_source_of_fund',
        ];
}










