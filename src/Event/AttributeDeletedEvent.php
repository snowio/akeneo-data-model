<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AttributeData;

class AttributeDeletedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->previousData = AttributeData::fromJson($json);
        // right now the akeneo connector only provides one timestamp
        $event->timestamp = (int)$json['@timestamp'];
        $event->previousTimestamp = (int)$json['@timestamp'];
        return $event;
    }

    public function getAttributeCode(): string
    {
        return $this->previousData->getCode();
    }

    public function getPreviousAttributeData(): AttributeData
    {
        return $this->previousData;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): int
    {
        return $this->previousTimestamp;
    }

    /** @var AttributeData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
