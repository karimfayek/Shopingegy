<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     protected $table = 'countries';
   
      protected $fillable = [
        'name', 'ship','sortname','name2'
    ];
	
	 /**
     * @var array
     */
    protected $casts = [
        'ship'  =>  'boolean'
    ];
}
