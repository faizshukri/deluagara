<?php

namespace Katsitu;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    public function user()
    {
        return $this->belongsTo('Katsitu\User');
    }
}
