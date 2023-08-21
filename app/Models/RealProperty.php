<?php

namespace App\Models;

use App\Models\AccountableForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_no_pf_no_25',
        'period_covered',
        'classification',
        'tax_declaration_no',
        'barangay',
        'accountable_form_id'
    ];

    public const CLASS_AGRICULTURAL = 1;
    public const CLASS_RESIDENTIAL = 2;
    public const CLASS_COMMERCIAL = 3;

    public function accountable_form () 
    {
        return $this->belongsTo(AccountableForm::class);    
    }

}
