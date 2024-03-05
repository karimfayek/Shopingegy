<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * @var string
     */
    protected $table = 'translations';

    /**
     * @var array
     */
    protected $fillable = [
        'header', 'ar', 'en'
    ];



 

    public function getLocalNameAttribute()
    {
         $local= session()->get('local');
         if($local == "ar"){
              return "{$this->ar}";
         }else{
              return "{$this->en}";
         }
        
    }
    
    protected $appends = ['LocalName'];
}
