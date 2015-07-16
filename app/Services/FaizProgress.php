<?php


namespace App\Services;

use App\Contracts\HashID;
use App\Contracts\Progress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaizProgress implements Progress{

    private $request;

    private $user;

    private $progress;

    private $hashid;

    private $activity = [];

    public function __construct(Request $request, HashID $hashid)
    {
        $this->request = $request;
        $this->hashid = $hashid;
        $this->user = $this->request->user();
        $this->activity = $this->user->activity ? unserialize($this->user->activity) : [];

        $this->calculate();
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function updateProgress(User $user = null)
    {
        foreach($this->distribution() as $name => $distribution) {
            if ($distribution['condition']() && !in_array($name, $this->activity, true))
                $this->addActivity($name);
        }
    }

    public function addActivity($name)
    {
        $this->progress += $this->distribution($name);
        $this->activity[] = $name;

        $this->user->progress = $this->progress;
        $this->user->activity = serialize($this->activity);
        $this->user->save();
    }

    public function distribution($name = null)
    {
        $activities = [
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
                    return true;
                }
            ],
            'validate_email' => [
                'point' => 10,
                'condition' => function() {
                    return true;
                }
            ],
            'share'          => [
                'point' => 10,
                'condition' => function() {
                    return true;
                }
            ]
        ];

        if (!$name) return $activities;

        return isset($activities[$name]) ? $activities[$name]['point'] : 0;
    }

    private function calculate()
    {
        $this->progress = 0;
        foreach ($this->activity as $activity) {
            $this->progress += $this->distribution($activity);
        }
    }

}