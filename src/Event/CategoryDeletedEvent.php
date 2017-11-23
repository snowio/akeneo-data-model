<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\CategoryData;

final class CategoryDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = CategoryData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getCategoryCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getPreviousCategoryData(): CategoryData
    {
        return $this->getPreviousEntityData();
    }
}
