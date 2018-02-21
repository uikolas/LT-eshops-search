<?php

namespace App\Client;

use Clue\React\Buzz\Browser;
use React\EventLoop\LoopInterface;

class Client
{
    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var Browser
     */
    private $browser;

    public function __construct(LoopInterface $loop, Browser $browser)
    {
        $this->loop = $loop;
        $this->browser = $browser;
    }

    /**
     * @param string $url
     * @return \React\Promise\PromiseInterface
     */
    public function get($url)
    {
        return $this->browser->get($url);
    }

    public function run()
    {
        $this->loop->run();
    }
}
