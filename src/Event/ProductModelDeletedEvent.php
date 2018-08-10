<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductModelData;

final class ProductModelDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = ProductModelData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getProductModelCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getPreviousProductModelData()->getChannel();
    }

    public function getPreviousProductModelData(): ProductModelData
    {
        return $this->getPreviousEntityData();
    }
}
