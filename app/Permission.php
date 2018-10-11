<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
      'user_id','menu_id','status'
    ];

    public function menus()
    {
        return $this->belongsTo('App\Menu','menu_id');
    }

    public static function creator($data,$user_id,$menu_id)
    {
        $permit = new Permission;

        $permit->user_id = $user_id;
        $permit->menu_id = $menu_id;

        if(in_array($menu_id,$data->menu_id))
        {
            $permit->status = 1;
        }
        else
        {
            $permit->status = 0;
        }

        $permit->save();
    }
}
