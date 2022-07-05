<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faq extends Model
{

    protected $fillable = [
        'topic_en', 'topic_hi', 'status'
    ];

   
    public function getQuestion(){
        return $this->hasMany(FaqQuestion::class,'faq_topic_id','id');
    }


    
}
