<?php

namespace AppBundle\Service;

class Util
{
    /**
     * @param $string
     * @return bool
     */
    public static function hasHttp($string)
    {
        return strpos($string, "http://") !== false;
    }
}
