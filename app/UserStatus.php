<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $fillable = [ 'title' ];

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
