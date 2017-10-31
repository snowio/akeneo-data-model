<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\VariantGroupData;

class VariantGroupDeletedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->previousData = VariantGroupData::fromJson($json);
        // right now the akeneo connector only provides one timestamp
        $event->timestamp = (int)$json['@timestamp'];
        $event->previousTimestamp = (int)$json['@timestamp'];
        return $event;
    }

    public function getVariantGroupCode(): string
    {
        return $this->previousData->getCode();
    }

    public function getChannel(): string
    {
        return $this->previousData->getChannel();
    }

    public function getPreviousVariantGroupData(): VariantGroupData
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

    /** @var VariantGroupData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
