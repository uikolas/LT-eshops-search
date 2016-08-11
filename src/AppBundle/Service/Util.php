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

    /**
     * @param $url
     * @param $link
     * @return string
     */
    public static function addLink($url, $link)
    {
        $trim = ltrim($link, '/');

        return $url.$trim;
    }
}
