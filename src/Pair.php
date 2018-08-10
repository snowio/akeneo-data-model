<?php

namespace SnowIO\AkeneoDataModel;

abstract class Pair
{
    public static function of($first, $second) : self
    {
        $pair =  new static;
        $pair->first = $first;
        $pair->second = $second;
        return $pair;
    }

    private $first;
    private $second;

    public function getFirst()
    {
        return $this->first;
    }

    public function getSecond()
    {
        return $this->second;
    }

    public function fromJson(array $json)
    {
        return self::of($json["1"], $json["2"]);
    }
}