<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountable_form_id',
        'field_a',
        'field_b',
        'field_c',
        'field_c1',
        'penalties'
    ];

    public function accountable_form () 
    {
        return $this->db->belongsTo(AccountableForm::class);
    }

    public function create (AccountableForm $accountableForm) 
    {

        dd($accountableForm);
    }

    public function store () 
    {

    }
}
