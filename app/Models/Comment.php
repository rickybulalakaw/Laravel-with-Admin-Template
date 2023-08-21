<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        // 'body',
        'body',
        'user_id',
        'accountable_form_id'
    ];

    // public function accountable_form () 
    // {
    //     return $this->belongsTo(AccountableForm::class);
    // }

    public function user () 
    {
        return $this->belongsTo(User::class);
    }
}
