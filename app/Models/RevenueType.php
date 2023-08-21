<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueType extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'name',
        'single_display',
        'column_display',
        'fund'
    ];

    public const CTC_A = 1;
    public const CTC_B = 2;
    public const CTC_C = 3;
    public const CTC_C1 = 4;

    public const FUND_100 = 100;
    public const FUND_200 = 200; 
    public const FUND_300 = 300;

    public function accountable_form_item () 
    {
        return $this->belongsTo(AccountableFormItem::class);
    }

}