<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilloSettings extends Model
{
    protected $fillable = [
        'company_id', 'account_sid', 'auth_token', 'application_sid'
    ];

    protected $table = 'twillo_settings';
}