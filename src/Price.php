<?php
namespace SnowIO\AkeneoDataModel;

class Price
{
    public static function of(string $amount, string $currency): self
    {
        return new self($amount, $currency);
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    private $amount;
    private $currency;

    private function __construct(string $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }
}
