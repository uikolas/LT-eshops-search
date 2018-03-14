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
     */
    public function get($url, callable $success, callable $error = null)
    {
        $this->browser->get($url)->then($success, $error);
    }
}
