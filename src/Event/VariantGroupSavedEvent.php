<?php
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\VariantGroupData;

class VariantGroupSavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = VariantGroupData::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = VariantGroupData::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getVariantGroupCode(): string
    {
        return $this->currentData->getCode();
    }

    public function getChannel(): string
    {
        return $this->currentData->getChannel();
    }

    public function getCurrentVariantGroupData(): VariantGroupData
    {
        return $this->currentData;
    }

    public function getPreviousVariantGroupData(): ?VariantGroupData
    {
        return $this->previousData;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): ?int
    {
        return $this->previousTimestamp;
    }

    /** @var VariantGroupData */
    private $currentData;
    /** @var VariantGroupData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
