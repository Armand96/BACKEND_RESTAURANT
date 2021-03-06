<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Today extends Model
{
    protected $table = 'order_today';
    protected $primaryKey = 'order_id';
    // protected $incrementing = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'menu_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'order_date'
    ];
}
