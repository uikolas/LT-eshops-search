<?php

namespace App\Client;

use Clue\React\Buzz\Browser;
use React\EventLoop\LoopInterface;

class ReactClient implements ClientInterface
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * @param Browser $browser
     */
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @param string $url
     * @param callable $success
     * @param callable|null $error
     * @param array $headers
     */
    public function get(string $url, callable $success, callable $error = null, array $headers = [])
    {
        $this->browser->get($url, $headers)->then($success, $error);
    }

    /**
     * @param string $url
     * @param callable $success
     * @param callable|null $error
     * @param array $headers
     * @return void
     */
    public function post(string $url, callable $success, callable $error = null, array $headers = [])
    {
        $this->browser->post($url, $headers)->then($success, $error);
    }
}
