<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
    use TransformableTrait,
        SoftDeletes;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipcode'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
