<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateCustomFields extends Model
{
    protected $fillable = [
        'company_id', 'template_id', 'default_field_id', 'section_id', 'label', 'type', 'value', 'default_options', 'custom_options', 'field_condition'
    ];

    protected $table = 'template_custom_fields';
}