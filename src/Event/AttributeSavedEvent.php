<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeData;

final class AttributeSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = AttributeData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = AttributeData::fromJson($json['old']);
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

    public function getAttributeCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getCurrentAttributeData(): AttributeData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousAttributeData(): ?AttributeData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousAttributeData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}
