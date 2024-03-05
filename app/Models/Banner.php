<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function getLocalNameAttribute()
    {
         $local= session()->get('local');
         if($local == "ar"){
              return "{$this->name2}";
         }else{
              return "{$this->name}";
         }
        
    }
    public function getLocalDescriptionAttribute()
    {
        $local= session()->get('local');
        if($local == "ar"){
            return "{$this->description2}";
        }else{
            return "{$this->description}";
        }
        
    }
}
