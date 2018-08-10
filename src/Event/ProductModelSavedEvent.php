<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductModelData;

final class ProductModelSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = ProductModelData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = ProductModelData::fromJson($json['old']);
            $previousTimestamp = (int)$json['old']['@timestamp'];
        } else {
            $previousData = null;
            $previousTimestamp = null;
        }
        return new self(
            $currentData->getCode(),
            $currentData,
            $previousData,
            $currentTimestamp,
            $previousTimestamp
        );
    }

    public function getProductModelCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getCurrentProductModelData()->getChannel();
    }

    public function getCurrentProductModelData(): ProductModelData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousProductModelData(): ?ProductModelData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousProductModelData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
