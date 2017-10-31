<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\CategoryData;

class CategoryDeletedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->previousData = CategoryData::fromJson($json);
        // right now the akeneo connector only provides one timestamp
        $event->timestamp = (int)$json['@timestamp'];
        $event->previousTimestamp = (int)$json['@timestamp'];
        return $event;
    }

    public function getCategoryCode(): string
    {
        return $this->previousData->getCode();
    }

    public function getPreviousCategoryData(): CategoryData
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

    /** @var CategoryData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
