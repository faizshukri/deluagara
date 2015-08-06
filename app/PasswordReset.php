<?php

namespace Katsitu;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public function user()
    {
        return $this->belongsTo('Katsitu\User');
    }
}
