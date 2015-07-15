<?php


namespace App\Services;


use App\Contracts\HashID;
use Jenssegers\Optimus\Optimus;

class OptimusHashID implements HashID{

    private $optimus;

    public function __construct()
    {
        $this->optimus = new Optimus(83258891, 1765813667, 342403140);
    }

    public function encode($val)
    {
        return $this->optimus->encode($val);
    }

    public function decode($val)
    {
        return $this->optimus->decode($val);
    }
}