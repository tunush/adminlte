<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactCustomSections extends Model
{
    protected $fillable = [
        'title', 'full', 'section_condition', 'sort_id'
    ];

    protected $table = 'contact_custom_sections';
}