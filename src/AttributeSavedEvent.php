<?php
namespace SnowIO\AkeneoDataModel;

class AttributeSavedEvent
{
    public static function fromJson(array $json): self
    {
        $oldData = isset($json['old']) ? Attribute::fromJson($json['old']) : null;
        $newData = Attribute::fromJson($json['new']);
        return new self($newData, $oldData);
    }

    public function getCode(): string
    {
        return $this->newData->getCode();
    }

    public function getNewData(): Attribute
    {
        return $this->newData;
    }

    public function getOldData(): ?Attribute
    {
        return $this->oldData;
    }

    private $newData;
    private $oldData;

    private function __construct(Attribute $newData, Attribute $oldData = null)
    {
        $this->newData = $newData;
        $this->oldData = $oldData;
    }
}
