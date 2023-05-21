<?php

namespace App\Traits;

trait GlobalTrait {

    public function trim(string $string) : string
    {
        return trim($string);
    }

    public function upper(string $string) : string
    {
        return strtoupper($string);
    }

    public function ucfirst(string $string) : string
    {
        return ucfirst($string);
    }

    public function onlynumbers(string $number) : string
    {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }
}