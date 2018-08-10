<?php

namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\FamilyVariantData;

final class FamilyVariantDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json)
    {
        $previousData = FamilyVariantData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp']
        );
    }

    public function getFamilyVariantCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getPreviousFamilyVariant(): FamilyVariantData
    {
        return $this->getPreviousEntityData();
    }
}
