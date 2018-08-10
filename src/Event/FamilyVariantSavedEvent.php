<?php
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\FamilyVariantData;

final class FamilyVariantSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = FamilyVariantData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = FamilyVariantData::fromJson($json['old']);
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


    public function getFamilyVariantCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getFamily(): string
    {
        return $this->getCurrentFamilyVariantData()->getFamily();
    }

    public function getCurrentFamilyVariantData(): FamilyVariantData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousFamilyVariantData(): ?FamilyVariantData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousFamilyVariantData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}