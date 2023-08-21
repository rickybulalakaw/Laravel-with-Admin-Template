<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountableFormType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'default_amount'
    ];

    // accountable form types
    public const OFFICIAL_RECEIPT = 1;
    public const RPT_RECEIPT = 7;
    public const CTC_INDIVIDUAL = 8;
    public const CTC_CORPORATION = 9;

    public function accountable_form ()
    {
        return $this->belongsTo(AccountableForm::class);
    } 
}
