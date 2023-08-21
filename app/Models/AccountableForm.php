<?php

namespace App\Models;

use App\Models\User; 
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountableForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountable_form_type_id',
        'accountable_form_number',
        'user_id',
        // 'date',
        'form_date',
        'payor',
        
        'use_status',
        'accounting_status'
    ];

    // use status 
    public const IS_ASSIGNED = 1;
    public const IS_USED = 2;
    public const IS_CANCELLED = 3;

    // accounting status 
    public const IS_SUBMITTED = 1;
    public const IS_RETURNED = 2;
    public const IS_REVIEWED_CONSOLIDATOR = 3;
    public const IS_REVIEWED_ENDORSER = 4;
    public const IS_APPROVED = 5;


    public function user () {
        return $this->belongsTo(User::class);
    }

    public function accountable_form_items () {
        return $this->hasMany(AccountableFormItem::class);
    }

    public function accountable_form_type () 
    {
        return $this->hasOne(AccountableFormType::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    
}
