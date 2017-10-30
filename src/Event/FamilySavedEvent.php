<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\FamilyData;

class FamilySavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = FamilyData::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = FamilyData::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getFamilyCode(): string
    {
        return $this->currentData->getCode();
    }

    public function getCurrentFamilyData(): FamilyData
    {
        return $this->currentData;
    }

    public function getPreviousFamilyData(): ?FamilyData
    {
        return $this->previousData;
    }

    public function hasPreviousFamilyData(): bool
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

    /** @var FamilyData */
    private $currentData;
    /** @var FamilyData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
