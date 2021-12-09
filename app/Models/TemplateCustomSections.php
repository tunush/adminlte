<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateCustomSections extends Model
{
    protected $fillable = [
        'company_id', 'template_id', 'title', 'full', 'section_condition', 'sort_id'
    ];

    protected $table = 'template_custom_sections';
}