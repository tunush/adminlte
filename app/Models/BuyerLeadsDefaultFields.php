<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerLeadsDefaultFields extends Model
{
    protected $fillable = [
        'label', 'type', 'value', 'default_options'
    ];

    protected $table = 'buyer_leads_default_fields';
}