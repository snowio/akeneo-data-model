<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductData;

final class ProductSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = ProductData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = ProductData::fromJson($json['old']);
            $previousTimestamp = (int)$json['old']['@timestamp'];
        } else {
            $previousData = null;
            $previousTimestamp = null;
        }
        return new self(
            $currentData->getSku(),
            $currentData,
            $previousData,
            $currentTimestamp,
            $previousTimestamp
        );
    }

    public function getProductSku(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getCurrentProductData()->getChannel();
    }

    public function getCurrentProductData(): ProductData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousProductData(): ?ProductData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousProductData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
