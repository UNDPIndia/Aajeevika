<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChatMessage extends Model
{

    protected $fillable = [
        'msg_en', 'msg_hi','status'
    ];

    public $timestamps = false;

   



    

}
