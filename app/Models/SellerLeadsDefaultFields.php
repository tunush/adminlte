<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerLeadsDefaultFields extends Model
{
    protected $fillable = [
        'company_id', 'label', 'type', 'value', 'default_options'
    ];

    protected $table = 'seller_leads_default_fields';
}