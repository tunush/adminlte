<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerLeadsCustomSections extends Model
{
    protected $fillable = [
        'title', 'full', 'section_condition', 'sort_id'
    ];

    protected $table = 'buyer_leads_custom_sections';
}