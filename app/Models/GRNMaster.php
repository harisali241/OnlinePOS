<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class GRNMaster extends Model
{
    protected $fillable = [
        'grn_master_no','date','total_balance','company_id','vendor_id','branch_id','user_id','total_amount'
    ];
    public function vendors()
    {
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function branches()
    {
        return $this->belongsTo('App\Models\branch','branch_id');
    }
    public function g_r_n_details()
    {
        return $this->hasMany('App\Models\GRNDetail','grn_master_id');
    }

    public static function createGRN($data)
    {
        $grn = new GRNMaster;
        $grn->company_id = auth()->user()->company_id;
        $grn->user_id = auth()->user()->id;
        $grn->branch_id = $data['branch_id'];
        $grn->vendor_id = $data['vendor_id'];
        $grn->grn_master_no = $data['grn_master_no'];
        $grn->date = $data['grn_Date'];
        $grn->total_amount = $data['grand_total'];
        $grn->total_balance = $data['total_balance'];

        $grn->save();
    }
}
