<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactCustomFields extends Model
{
    protected $fillable = [
        'default_field_id', 'section_id', 'label', 'type', 'value', 'default_options', 'custom_options'
    ];

    protected $table = 'contact_custom_fields';
}