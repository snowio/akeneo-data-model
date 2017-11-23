<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\VariantGroupData;

final class VariantGroupDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = VariantGroupData::fromJson($json);
        return new self(
            $previousData->getCode(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getVariantGroupCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getPreviousVariantGroupData()->getChannel();
    }

    public function getPreviousVariantGroupData(): VariantGroupData
    {
        return $this->getPreviousEntityData();
    }
}
