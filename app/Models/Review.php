<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
       /**
     * @var string
     */
    protected $table = 'reviews';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'rate', 'review',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'product_id'  =>  'integer',
        'user_id'  =>  'integer',
        'rate'  =>  'integer'
    ];
	
	 public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	 public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
