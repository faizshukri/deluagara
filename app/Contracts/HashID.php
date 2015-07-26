<?php


namespace Katsitu\Contracts;


interface HashID {
    public function encode($val);
    public function decode($val);
}