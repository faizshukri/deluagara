<?php


namespace App\Services;

use App\Contracts\HashID;
use App\Contracts\Progress;
use Illuminate\Http\Request;

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

    public function updateProgress()
    {
        if (strpos($this->user->profile_image, strval($this->hashid->encode($this->user->id)) ) !== false) {

            // Only add to activity if this not exist
            if (array_search('profile_image', $this->activity) === false) {
                $this->addActivity('profile_image');
            }
        }
    }

    public function addActivity($name, $user = null)
    {
        if(!$user) $user = $this->user;
        $this->progress += $this->distribution($name);
        $this->activity[] = $name;

        $user->progress = $this->progress;
        $user->activity = serialize($this->activity);
        $user->save();
    }

    private function distribution($name)
    {
        return [
            'register'       => 10,
            'profile_image'  => 20,
            'address'        => 10,
            'about_me'       => 10,
            'url'            => 20,
            'validate_email' => 20,
            'share'          => 10
        ][$name];
    }

    private function calculate()
    {
        $this->progress = 0;
        foreach ($this->activity as $activity) {
            $this->progress += $this->distribution($activity);
        }
    }

}