<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateDefaultFields extends Model
{
    protected $fillable = [
        'company_id', 'template_id', 'label', 'type', 'value', 'default_options'
    ];

    protected $table = 'template_default_fields';
}