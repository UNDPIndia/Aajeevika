<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FaqQuestion extends Model
{

    protected $fillable = [
        'faq_topic_id', 'question_en', 'question_hi', 'desc_en','desc_hi','status'
    ];

   
    public function getFaq() {
        return $this->hasOne(Faq::class, 'id', 'faq_topic_id');
        
    }
}
