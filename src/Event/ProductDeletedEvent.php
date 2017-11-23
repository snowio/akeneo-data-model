<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\ProductData;

final class ProductDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = ProductData::fromJson($json);
        return new self(
            $previousData->getSku(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getProductSku(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getPreviousProductData()->getChannel();
    }

    public function getPreviousProductData(): ProductData
    {
        return $this->getPreviousEntityData();
    }
}
