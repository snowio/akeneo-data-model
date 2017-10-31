<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductData;

class ProductDeletedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->previousData = ProductData::fromJson($json);
        // right now the akeneo connector only provides one timestamp
        $event->timestamp = (int)$json['@timestamp'];
        $event->previousTimestamp = (int)$json['@timestamp'];
        return $event;
    }

    public function getProductSku(): string
    {
        return $this->previousData->getSku();
    }

    public function getChannel(): string
    {
        return $this->previousData->getChannel();
    }

    public function getPreviousProductData(): ProductData
    {
        return $this->previousData;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): int
    {
        return $this->previousTimestamp;
    }

    /** @var ProductData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
