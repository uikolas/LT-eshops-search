<?php

namespace App;

class Product implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $shop;

    /**
     * @param string $name
     * @param string $image
     * @param string $price
     * @param string $url
     * @param string $shop
     */
    public function __construct(string $name, string $image, string $price, string $url, string $shop)
    {
        $this->name  = $name;
        $this->image = $image;
        $this->price = $price;
        $this->url   = $url;
        $this->shop  = $shop;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'  => $this->name,
            'image' => $this->image,
            'price' => $this->price,
            'url'   => $this->url,
            'shop'  => $this->shop,
        ];
    }
}
