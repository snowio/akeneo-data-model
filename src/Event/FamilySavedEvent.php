<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\FamilyData;

final class FamilySavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = FamilyData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = FamilyData::fromJson($json['old']);
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

    public function getFamilyCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getCurrentFamilyData(): FamilyData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousFamilyData(): ?FamilyData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousFamilyData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
