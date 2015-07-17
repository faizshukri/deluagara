<?php


namespace App\Services;

use App\Contracts\HashID;
use App\Contracts\Progress;
use App\User;
use Illuminate\Http\Request;

class FaizProgress implements Progress{

    private $request;

    private $user;

    private $progress;

    private $hashid;

    public $activity = [];

    public $distribution;

    public function __construct(Request $request, HashID $hashid)
    {
        $this->request = $request;
        $this->hashid = $hashid;
        $this->user = $this->request->user();
        $this->activity = $this->user->activity ? unserialize($this->user->activity) : [];
        $this->initDistribution();
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

        return $progress / $total * 100;
    }

    public function updateProgress(User $user = null)
    {
        foreach($this->distribution as $name => $distribution) {
            $this->addActivity($name);
        }
    }

    public function addActivity($name)
    {
        if ($this->distribution[$name]['condition']() && !in_array($name, $this->activity, true)) {
            $this->progress += $this->getPoint($name);
            $this->activity[] = $name;

            $this->user->progress = $this->progress;
            $this->user->activity = serialize($this->activity);
            $this->user->save();
        }
    }

    public function getPoint($name)
    {
        return isset($this->distribution[$name]) ? $this->distribution[$name]['point'] : 0;
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
                    return isset($this->user->location) && isset($this->user->location->city);
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
                    return false;
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
            ]
        ];
    }
}