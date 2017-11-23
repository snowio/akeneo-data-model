<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeData;

final class AttributeDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = AttributeData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getAttributeCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getPreviousAttributeData(): AttributeData
    {
        return $this->getPreviousEntityData();
    }
}
