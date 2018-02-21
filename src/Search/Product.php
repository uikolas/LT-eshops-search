<?php

namespace App\Search;

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
    private $shopName;

    /**
     * @param string $name
     * @param string $image
     * @param string $price
     * @param string $url
     * @param string $shopName
     */
    public function __construct($name, $image, $price, $url, $shopName)
    {
        $this->name     = $name;
        $this->image    = $image;
        $this->price    = $price;
        $this->url      = $url;
        $this->shopName = $shopName;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name'      => $this->name,
            'image'     => $this->image,
            'price'     => $this->price,
            'url'       => $this->url,
            'shop_name' => $this->shopName,
        ];
    }
}
