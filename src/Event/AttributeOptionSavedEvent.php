<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeOption;
use SnowIO\AkeneoDataModel\AttributeOptionIdentifier;
use SnowIO\AkeneoDataModel\InternationalizedString;

final class AttributeOptionSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = AttributeOption::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = AttributeOption::fromJson($json['old']);
            $previousTimestamp = (int)$json['old']['@timestamp'];
        } else {
            $previousData = null;
            $previousTimestamp = null;
        }
        return new self(
            $currentData->getIdentifier(),
            $currentData,
            $previousData,
            $currentTimestamp,
            $previousTimestamp
        );
    }

    public function getAttributeOptionIdentifier(): AttributeOptionIdentifier
    {
        return $this->getEntityIdentifier();
    }

    public function getAttributeCode(): string
    {
        return $this->getAttributeOptionIdentifier()->getAttributeCode();
    }

    public function getOptionCode(): string
    {
        return $this->getAttributeOptionIdentifier()->getOptionCode();
    }

    public function getCurrentAttributeOptionData(): AttributeOption
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousAttributeOptionData(): ?AttributeOption
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousAttributeOptionData(): bool
    {
        return $this->hasPreviousEntityData();
    }

    public function getCurrentAttributeOptionLabels(): InternationalizedString
    {
        return $this->getCurrentAttributeOptionData()->getLabels();
    }

    public function getPreviousAttributeOptionLabels(): InternationalizedString
    {
        return $this->hasPreviousAttributeOptionData() ? $this->getPreviousAttributeOptionData()->getLabels() : InternationalizedString::create();
    }
}
