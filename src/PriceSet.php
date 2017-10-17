<?php
namespace SnowIO\AkeneoDataModel;

class PriceSet implements \IteratorAggregate
{
    public function hasPrice(string $currencyCode): bool
    {
        return isset($this->prices[$currencyCode]);
    }

    public function getPrice(string $currencyCode): ?string
    {
        return $this->prices[$currencyCode] ?? null;
    }

    public static function fromJson(array $json): PriceSet
    {
        $prices = [];
        foreach ($json as $currencyCode => $price) {
            if (!\is_string($currencyCode)) {
                throw new \Error;
            }
            if ($price === null) {
                continue;
            }
            if (!\is_string($price)) {
                throw new \Error;
            }
            $prices[$currencyCode] = $price;
        }
        return new PriceSet($prices);
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->prices as $currencyCode => $price) {
            yield $currencyCode => $price;
        }
    }

    public function toArray(): array
    {
        return $this->prices;
    }

    private $prices;

    private function __construct(array $prices)
    {
        $this->prices = $prices;
    }
}
