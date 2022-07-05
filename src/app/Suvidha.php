<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Suvidha extends Model
{

    protected $fillable = [
        'title_en', 'title_hi', 'image1', 'image2','image3','image4','desc_en','desc_hi','status'
    ];

   



    

}
