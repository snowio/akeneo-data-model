<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\VariantGroupData;

final class VariantGroupSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = VariantGroupData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = VariantGroupData::fromJson($json['old']);
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

    public function getVariantGroupCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getCurrentVariantGroupData()->getCode();
    }

    public function getCurrentVariantGroupData(): VariantGroupData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousVariantGroupData(): ?VariantGroupData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousVariantGroupData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
