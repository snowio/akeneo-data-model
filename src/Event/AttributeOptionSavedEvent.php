<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeOption;
use SnowIO\AkeneoDataModel\AttributeOptionIdentifier;
use SnowIO\AkeneoDataModel\InternationalizedString;

class AttributeOptionSavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = AttributeOption::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = AttributeOption::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getAttributeOptionIdentifier(): AttributeOptionIdentifier
    {
        return $this->currentData->getIdentifier();
    }

    public function getAttributeCode(): string
    {
        return $this->currentData->getAttributeCode();
    }

    public function getOptionCode(): string
    {
        return $this->currentData->getOptionCode();
    }

    public function getCurrentAttributeOptionData(): AttributeOption
    {
        return $this->currentData;
    }

    public function getPreviousAttributeOptionData(): ?AttributeOption
    {
        return $this->previousData;
    }

    public function getCurrentAttributeOptionLabels(): InternationalizedString
    {
        return $this->currentData->getLabels();
    }

    public function getPreviousAttributeOptionLabels(): ?InternationalizedString
    {
        return $this->previousData ? $this->previousData->getLabels() : InternationalizedString::create();
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): ?int
    {
        return $this->previousTimestamp;
    }

    /** @var AttributeOption */
    private $currentData;
    /** @var AttributeOption */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
