<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerLeadsCustomFields extends Model
{
    protected $fillable = [
        'company_id', 'default_field_id', 'section_id', 'label', 'type', 'value', 'default_options', 'custom_options', 'field_condition'
    ];

    protected $table = 'buyer_leads_custom_fields';
}