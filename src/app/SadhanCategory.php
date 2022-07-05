<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SadhanCategory extends Model
{

    protected $fillable = [
        'name_en', 'name_hi','cat_status'
    ];

   
    public function getSadhan()
    {
        return $this->hasMany(Sadhan::class, 'category_id', 'id')->where('status','=', 0);

    }


    

}
