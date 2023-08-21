<?php

namespace App\Models;

use App\Models\RevenueType;
use App\Models\AccountableForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountableFormItem extends Model
{
    use HasFactory;

    public $fillable = [
        'accountable_form_id',
        'amount',
        'revenue_type_id'
    ];



    public function revenue_type(){
        return $this->hasOne(RevenueType::class,'id','revenue_type_id');
    }

    public function accountable_form(){

        return $this->belongsTo(AccountableForm::class);
    }
    

    
}
