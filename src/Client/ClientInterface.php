<?php

namespace App\Client;

interface ClientInterface
{
    /**
     * @param string $url
     * @param callable $success
     * @param callable|null $error
     * @param array $headers
     * @return void
     */
    public function get(string $url, callable $success, callable $error = null, array $headers = []);
}
