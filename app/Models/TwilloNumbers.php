<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwilloNumbers extends Model
{
    protected $fillable = [
        'name', 'phone_number', 'forwarding_number', 'assigned_user', 'incoming_call_timeout', 
        'outbound_call_timeout', 'whisper_message', 'call_recording', 'pass_called_number', 'enable_call_connect'
    ];

    protected $table = 'twillo_numbers';
}