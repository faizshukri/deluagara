<?php

namespace Katsitu;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function users()
    {
        return $this->hasMany('Katsitu\User');
    }
}
