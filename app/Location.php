<?php

namespace Katsitu;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [ 'street', 'postcode', 'latitude', 'longitude' ];

    protected $hidden = [ 'user_id' ];

    public function user()
    {
        return $this->belongsTo('Katsitu\User');
    }

    public function city()
    {
        return $this->belongsTo('Katsitu\City');
    }
}
