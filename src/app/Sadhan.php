<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sadhan extends Model
{

    protected $fillable = [
        'category_id', 'youtube_url', 'title_en','title_hi', 'desc_en','desc_hi', 'status'
    ];

   



    

}
