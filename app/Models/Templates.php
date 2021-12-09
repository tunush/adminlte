<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $fillable = [
        'company_id', 'name', 'description', 'menu_name', 'ability_sort_menu'
    ];

    protected $table = 'templates';
}