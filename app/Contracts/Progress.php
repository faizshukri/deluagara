<?php


namespace Katsitu\Contracts;


interface Progress {
    public function getProgress();
    public function updateProgress();
    public function addActivity($activity_name);
    public function getPoint($activity_name);
    public function getPointPercentage($activity_name);
}