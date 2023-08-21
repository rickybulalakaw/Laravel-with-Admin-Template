<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    public const STATUS_UNREAD = 0;
    public const STATUS_READ = 1;

    protected $fillable = [
        'user_id',
        'subject',
        'entity',
        'entity_id',
        'message',
        'recipient_user_id',
        'message_id',
        'status'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }


}
