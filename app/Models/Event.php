<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id',
    'status',
    'organization_name',
    'activity_title',
    'type_of_activity',
    'activity_start_date',
    'activity_end_date',
    'activity_start_time',
    'activity_end_time',
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
    'letter_of_approval',
    ];
}
