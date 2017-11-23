<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeOption;
use SnowIO\AkeneoDataModel\AttributeOptionIdentifier;
use SnowIO\AkeneoDataModel\InternationalizedString;

final class AttributeOptionDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $previousData = AttributeOption::fromJson($json);
        return new self(
            $previousData->getIdentifier(),
            null,
            $previousData,
            (int)$json['@timestamp'],
            (int)$json['@timestamp'] // right now the akeneo connector only provides one timestamp for delete events
        );
    }

    public function getAttributeOptionIdentifier(): AttributeOptionIdentifier
    {
        return $this->getPreviousEntityData();
    }

    public function getAttributeCode(): string
    {
        return $this->getAttributeOptionIdentifier()->getAttributeCode();
    }

    public function getOptionCode(): string
    {
        return $this->getAttributeOptionIdentifier()->getOptionCode();
    }

    public function getPreviousAttributeOptionData(): AttributeOption
    {
        return $this->getPreviousEntityData();
    }

    public function getPreviousAttributeOptionLabels(): InternationalizedString
    {
        return $this->getPreviousAttributeOptionData()->getLabels();
    }
}
