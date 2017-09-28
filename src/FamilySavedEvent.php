<?php
namespace SnowIO\AkeneoDataModel;

class FamilySavedEvent
{
    public static function fromJson(array $json): self
    {
        $oldData = isset($json['old']) ? Family::fromJson($json['old']) : null;
        $newData = Family::fromJson($json['new']);
        return new self($newData, $oldData);
    }

    public function getCode(): string
    {
        return $this->newData->getCode();
    }

    public function getNewData(): Family
    {
        return $this->newData;
    }

    public function getOldData(): ?Family
    {
        return $this->oldData;
    }

    private $newData;
    private $oldData;

    private function __construct(Family $newData, Family $oldData = null)
    {
        $this->newData = $newData;
        $this->oldData = $oldData;
    }
}
