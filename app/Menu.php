<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_name','menu_slug','menu_route','parent_menu_id','icon','sort_order','status','hidden'
    ];
}
