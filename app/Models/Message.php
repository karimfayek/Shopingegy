<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
       /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'message', 'cv', 'type','qualification','age' ,'dept','loaction'
    ];

 
 
	
}
