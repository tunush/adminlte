<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDefaultFields extends Model
{
    protected $fillable = [
        'label', 'type', 'value', 'default_options'
    ];

    protected $table = 'contact_default_fields';
}