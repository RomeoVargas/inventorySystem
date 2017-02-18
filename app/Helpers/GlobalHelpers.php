<?php
use Illuminate\Support\Facades\Route;

function get_route_name()
{
    return $currentPath = Route::getFacadeRoot()->current()->uri();
}