<?php


namespace App\Services;


use App\Contracts\ImageHandler;
use Intervention\Image\Facades\Image;


class InterventionImageHandler implements ImageHandler{

    private $image;

    public function make($path)
    {
        $this->image = Image::make($path);
        return $this->image;
    }

    public function resize($width, $height)
    {
        $this->image = $this->image->resize($width, $height);
        return $this->image;
    }

    public function fit($width, $height = null)
    {
        $this->image = $this->image->fit($width, $height);
        return $this->image;
    }

    public function save($path = null, $quality = null)
    {
        $this->image = $this->image->save($path, $quality);
        return $this->image;
    }

    public function response($format = null, $quality = null)
    {
        return $this->image->response($format, $quality);
    }
}