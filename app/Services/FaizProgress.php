<?php


namespace App\Services;

use App\Contracts\HashID;
use App\Contracts\Progress;
use App\User;
use Illuminate\Http\Request;

class FaizProgress implements Progress{

    private $request;

    private $user;

    private $hashid;

    public $activity = [];

    public $distribution;

    public function __construct(Request $request, HashID $hashid)
    {
        $this->request = $request;
        $this->hashid = $hashid;
        $this->user = $this->request->user();
        $this->initDistribution();
        if($this->user){
            $this->activity = $this->user->activity ? unserialize($this->user->activity) : [];
        }
    }

    public function getProgress()
    {
        $progress = 0;
        foreach ($this->activity as $activity) {
            $progress += $this->getPoint($activity);
        }

        $total = 0;
        foreach($this->distribution as $distribution){
            $total += $distribution['point'];
        }

        return round($progress / $total * 100);
    }

    public function updateProgress(User $user = null)
    {
        if($user) $this->user = $user;
        if(!$this->user) return;
        foreach($this->distribution as $name => $distribution) {
            $this->addActivity($name);
        }
    }

    public function addActivity($name)
    {
        $fill_and_save = function(){
            $this->user->activity = serialize($this->activity);
            $this->user->save();
        };

        if ($this->distribution[$name]['condition']() && !in_array($name, $this->activity, true)) {
            $this->activity[] = $name;
            $fill_and_save();

        } else if (!$this->distribution[$name]['condition']() && in_array($name, $this->activity, true)) {

            // Remove the entry in $register
            if(($key = array_search($name, $this->activity)) !== false) {
                unset($this->activity[$key]);
            }
            $fill_and_save();
        }
    }

    public function getPoint($name)
    {
        return isset($this->distribution[$name]) ? $this->distribution[$name]['point'] : 0;
    }

    public function getPointPercentage($name)
    {
        $point = $this->getPoint($name);

        $total = 0;
        foreach($this->distribution as $distribution){
            $total += $distribution['point'];
        }

        return round($point / $total * 100);
    }

    protected function initDistribution()
    {
        $this->distribution = [
            'register'       => [
                'point' => 10,
                'condition' => function() {
                    return true;
                }
            ],
            'profile_image'  => [
                'point' => 20,
                'condition' => function() {
                    return strpos($this->user->profile_image, strval($this->hashid->encode($this->user->id))) !== false;
                }
            ],
            'address'        => [
                'point' => 20,
                'condition' => function() {
                    return $this->user->location && $this->user->location->city;
                }
            ],
            'about_me'       => [
                'point' => 10,
                'condition' => function() {
                    return $this->user->about_me;
                }
            ],
            'url'            => [
                'point' => 20,
                'condition' => function() {
                    return !empty($this->user->website) && !empty($this->user->facebook_url) && !empty($this->user->twitter_url);
                }
            ],
            'validate_email' => [
                'point' => 10,
                'condition' => function() {
                    return false;
                }
            ],
            'share'          => [
                'point' => 10,
                'condition' => function() {
                    return false;
                }
            ],
            'education' => [
                'point' => 20,
                'condition' => function() {
                    return !empty($this->user->user_status_id) && !empty($this->user->sponsor_id) && !empty($this->user->course_work);
                }
            ]
        ];
    }
}