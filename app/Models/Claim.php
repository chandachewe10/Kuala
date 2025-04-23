<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Claim extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'policy_number',
        'type',
        'incident_date',
        'incident_location',
        'description',
        'estimate_loss',
        'police_report_number',
        'witnesses',
        'ai_feedback',
        'userId',
        'attachment',
       
    ];
}
