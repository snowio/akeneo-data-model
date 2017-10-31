<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeOption;
use SnowIO\AkeneoDataModel\AttributeOptionIdentifier;
use SnowIO\AkeneoDataModel\InternationalizedString;

class AttributeOptionDeletedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->previousData = AttributeOption::fromJson($json);
        // right now the akeneo connector only provides one timestamp
        $event->timestamp = (int)$json['@timestamp'];
        $event->previousTimestamp = (int)$json['@timestamp'];
        return $event;
    }

    public function getAttributeOptionIdentifier(): AttributeOptionIdentifier
    {
        return $this->previousData->getIdentifier();
    }

    public function getAttributeCode(): string
    {
        return $this->previousData->getAttributeCode();
    }

    public function getOptionCode(): string
    {
        return $this->previousData->getOptionCode();
    }

    public function getPreviousAttributeOptionData(): AttributeOption
    {
        return $this->previousData;
    }

    public function getPreviousAttributeOptionLabels(): InternationalizedString
    {
        return $this->previousData->getLabels();
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): int
    {
        return $this->previousTimestamp;
    }

    /** @var AttributeOption */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
