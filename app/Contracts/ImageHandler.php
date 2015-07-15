<?php


namespace App\Contracts;


interface ImageHandler {

    public function make($path);
    public function resize($width, $height);
    public function fit($width, $height);
    public function save($path, $quality);
    public function response($format, $quality);

}