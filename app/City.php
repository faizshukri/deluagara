<?php

namespace Katsitu;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [ 'name' ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function locations()
    {
        return $this->hasMany('Katsitu\Location');
    }
}
