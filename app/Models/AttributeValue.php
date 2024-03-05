<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'attribute_values';

    /**
     * @var array
     */
    protected $fillable = [
        'attribute_id', 'value', 'price' , 'valuear' ,'color'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'attribute_id'  =>  'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class);
    }


    public function getLocalNameAttribute()
    {
         $local= session()->get('local');
         if($local == "ar"){
              return "{$this->value}";
         }else{
              return "{$this->valuear}";
         }
        
    }


    protected $appends = ['LocalName'];

}
