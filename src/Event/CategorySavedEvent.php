<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\CategoryData;

class CategorySavedEvent
{
    public static function fromJson(array $json): self
    {
        $event = new self;
        $event->currentData = CategoryData::fromJson($json['new']);
        $event->timestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $event->previousData = CategoryData::fromJson($json['old']);
            $event->previousTimestamp = (int)$json['old']['@timestamp'];
        }
        return $event;
    }

    public function getCategoryCode(): string
    {
        return $this->currentData->getCode();
    }

    public function getCurrentCategoryData(): CategoryData
    {
        return $this->currentData;
    }

    public function getPreviousCategoryData(): ?CategoryData
    {
        return $this->previousData;
    }

    public function hasPreviousCategoryData(): bool
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

    /** @var CategoryData */
    private $currentData;
    /** @var CategoryData */
    private $previousData;
    private $timestamp;
    private $previousTimestamp;

    private function __construct()
    {

    }
}
