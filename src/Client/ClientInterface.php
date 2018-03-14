<?php

namespace App\Client;

interface ClientInterface
{
    /**
     * @param string $url
     * @param callable $success
     * @param callable|null $error
     */
    public function get($url, callable $success, callable $error = null);
}
