<?php

function set_active( $path, $class = 'active' )
{
    return Request::is($path) ? $class : '' ;
}