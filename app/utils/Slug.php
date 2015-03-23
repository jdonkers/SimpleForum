<?php

class Slug {

    public static function generate($string) 
    {
        return preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower(trim($string))));
    }
}