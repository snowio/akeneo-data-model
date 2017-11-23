<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\CategoryData;

final class CategorySavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = CategoryData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = CategoryData::fromJson($json['old']);
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

    public function getCategoryCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getCurrentCategoryData(): CategoryData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousCategoryData(): ?CategoryData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousCategoryData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
