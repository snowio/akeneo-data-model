<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductData;

class ProductSavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = ProductData::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = ProductData::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getProductSku(): string
    {
        return $this->currentData->getSku();
    }

    public function getChannel(): string
    {
        return $this->currentData->getChannel();
    }

    public function getCurrentProductData(): ProductData
    {
        return $this->currentData;
    }

    public function getPreviousProductData(): ?ProductData
    {
        return $this->previousData;
    }

    public function hasPreviousProductData(): bool
    {
        return isset($this->previousData);
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): ?int
    {
        return $this->previousTimestamp;
    }

    /** @var ProductData */
    private $currentData;
    /** @var ProductData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
