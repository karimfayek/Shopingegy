<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   protected $table = 'states';
   
      protected $fillable = [
        'name', 'country_id', 'ship', 'ship_price'
    ];
	
	 /**
     * @var array
     */
    protected $casts = [
        'country_id' =>  'integer',
        'ship'  =>  'boolean'
    ];
	
	 public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function getLocalNameAttribute()
    {
         $local= session()->get('local');
         if($local == "ar"){
              return "{$this->name2}";
         }else{
              return "{$this->name}";
         }
        
    }
}
