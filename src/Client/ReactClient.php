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
     * @param LoopInterface $loop
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
}
