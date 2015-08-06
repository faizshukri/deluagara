<?php

namespace Katsitu;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'username', 'email', 'password', 'gender', 'user_status_id', 'sponsor_id', 'course_work',
        'end_date', 'phone', 'about_me', 'website', 'facebook_url', 'twitter_url', 'profile_image', 'confirmation_code','activity' ];

    protected $guarded = [ 'id', 'password' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function location()
    {
        return $this->hasOne('Katsitu\Location');
    }

    public function status()
    {
        return $this->belongsTo('Katsitu\UserStatus', 'user_status_id');
    }

    public function sponsor()
    {
        return $this->belongsTo('Katsitu\Sponsor', 'sponsor_id');
    }

    public function getMarkerInfo()
    {
        $this->visible = [ 'name', 'profile_image', 'location' ];

        return $this->location ? [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [ floatval($this->location->longitude), floatval($this->location->latitude) ]
            ],
            'properties' => [
                'marker-color' => '#548cba',
                'marker-symbol' => 'building',
                'title' => $this->name,
                'description' => $this->location->city->name
            ]
        ] : [];
    }

}
