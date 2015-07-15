<?php


namespace App\Contracts;


interface HashID {
    public function encode($val);
    public function decode($val);
}