<?php
namespace SnowIO\AkeneoDataModel\Event;

abstract class EntityStateEvent
{
    public function getEntityIdentifier()
    {
        return $this->entityIdentifier;
    }

    public function getCurrentEntityData()
    {
        return $this->currentEntityData;
    }

    public function getPreviousEntityData()
    {
        return $this->previousEntityData;
    }

    public function hasPreviousEntityData()
    {
        return $this->previousEntityData !== null;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPreviousTimestamp(): int
    {
        return $this->previousTimestamp;
    }

    private $entityIdentifier;
    private $currentEntityData;
    private $previousEntityData;
    private $timestamp;
    private $previousTimestamp;

    protected function __construct(
        $entityIdentifier,
        $currentEntityData,
        $previousEntityData,
        int $timestamp,
        int $previousTimestamp
    ) {
        $this->entityIdentifier = $entityIdentifier;
        $this->currentEntityData = $currentEntityData;
        $this->previousEntityData = $previousEntityData;
        $this->timestamp = $timestamp;
        $this->previousTimestamp = $previousTimestamp;
    }
}
