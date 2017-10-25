<?php
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeData;

class AttributeSavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = AttributeData::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = AttributeData::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getAttributeCode(): string
    {
        return $this->currentData->getCode();
    }

    public function getCurrentAttributeData(): AttributeData
    {
        return $this->currentData;
    }

    public function getPreviousAttributeData(): ?AttributeData
    {
        return $this->previousData;
    }

    public function hasPreviousAttributeData(): bool
    {
        return isset($this->previousData);
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): ?int
    {
        return $this->previousTimestamp;
    }

    /** @var AttributeData */
    private $currentData;
    /** @var AttributeData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
