<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndividualInterestList extends Model
{
    //
    protected $fillable = [
        'product_id','name_en','name_hi','image', 'status' 
    ];

}
