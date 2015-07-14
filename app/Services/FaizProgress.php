<?php


namespace App\Services;

use App\Contracts\Progress;
use Illuminate\Http\Request;

class FaizProgress implements Progress{

    private $request;

    private $percentage;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->percentage = $request->user()->progress;
    }

    public function getProgress()
    {
        return $this->percentage;
    }

    private function distribution()
    {
        return [
            'profile_image'  => 20,
            'address'        => 10,
            'about_me'       => 10,
            'url'            => 20,
            'validate_email' => 20,
            'share'          => 10
        ];
    }

    private function calculate()
    {

    }
}