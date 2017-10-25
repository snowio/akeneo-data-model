<?php
namespace SnowIO\AkeneoDataModel;

class PriceCollection implements \IteratorAggregate
{
    public static function of(array $prices): self
    {
        $pricesByCurrency = [];
        foreach ($prices as $price) {
            if (!$price instanceof Price) {
                throw new AkeneoDataException;
            }
            if (isset($pricesByCurrency[$price->getCurrency()])) {
                throw new AkeneoDataException;
            }
            $pricesByCurrency[$price->getCurrency()] = $price;
        }
        return new self($pricesByCurrency);
    }

    public function hasPrice(string $currency): bool
    {
        return isset($this->prices[$currency]);
    }

    public function getPrice(string $currency): ?Price
    {
        return $this->prices[$currency] ?? null;
    }

    public function withPrice(Price $price): self
    {
        $result = clone $this;
        $result->prices[$price->getCurrency()] = $price;
        return $result;
    }

    public function getAmount(string $currency): ?string
    {
        return isset($this->prices[$currency]) ? $this->prices[$currency]->getAmount() : null;
    }

    public function filter(callable $predicate): self
    {
        $prices = \array_filter($this->prices, $predicate);
        return new self($prices);
    }

    public static function fromJson(array $json): PriceCollection
    {
        $prices = [];
        foreach ($json as $currencyCode => $amount) {
            if (!\is_string($currencyCode)) {
                throw new AkeneoDataException;
            }
            if ($amount === null) {
                continue;
            }
            if (!\is_string($amount)) {
                throw new AkeneoDataException;
            }
            $prices[$currencyCode] = Price::of($amount, $currencyCode);
        }
        return new PriceCollection($prices);
    }

    public function getIterator(): \Iterator
    {
        yield from \array_values($this->prices);
    }

    /** @var Price[] */
    private $prices;

    private function __construct(array $prices)
    {
        $this->prices = $prices;
    }
}
