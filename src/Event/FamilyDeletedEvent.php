<?php
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\FamilyData;

final class FamilyDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = FamilyData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getFamilyCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getPreviousFamilyData(): FamilyData
    {
        return $this->getPreviousEntityData();
    }
}
