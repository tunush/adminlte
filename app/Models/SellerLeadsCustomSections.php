<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerLeadsCustomSections extends Model
{
    protected $fillable = [
        'company_id', 'title', 'full', 'section_condition', 'sort_id'
    ];

    protected $table = 'seller_leads_custom_sections';
}