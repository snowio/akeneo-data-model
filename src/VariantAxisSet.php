<?php

namespace SnowIO\AkeneoDataModel;

class VariantAxisSet implements \IteratorAggregate
{
    use SetTrait;

    public static function fromJson(array $json): VariantAxisSet
    {
        self::validate($json);
        $result = self::of($json);
        return $result;
    }

    private static function validate(array $json)
    {
        if (count($json) > 5) {
            throw new AkeneoDataException('Invalid number of axes [should not exceed 5]');
        }
    }

    public function getAxes(): array
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