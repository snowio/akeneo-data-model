<?php

namespace SnowIO\AkeneoDataModel;


class VariantAttributeSet implements \IteratorAggregate
{
    use SetTrait;

    public static function fromJson(array $json): VariantAttributeSet
    {
        return self::of($json);
    }

    public function getAttributes(): array
    {
        return array_values($this->items);
    }


    public function equals(): bool
    {

    }

    private static function getKey($item)
    {
        return $item;
    }
}