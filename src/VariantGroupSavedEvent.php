<?php
namespace SnowIO\AkeneoDataModel;

class VariantGroupSavedEvent
{
    public static function fromJson(array $json): self
    {
        $oldData = isset($json['old']) ? SingleChannelVariantGroupData::fromJson($json['old']) : null;
        $newData = SingleChannelVariantGroupData::fromJson($json['new']);
        return new self($newData, $oldData);
    }

    public function getCode(): string
    {
        return $this->newData->getCode();
    }

    public function getChannel(): string
    {
        return $this->newData->getChannel();
    }

    public function getNewData(): SingleChannelVariantGroupData
    {
        return $this->newData;
    }

    public function getOldData(): ?SingleChannelVariantGroupData
    {
        return $this->oldData;
    }

    private $newData;
    private $oldData;

    private function __construct(SingleChannelVariantGroupData $newData, SingleChannelVariantGroupData $oldData = null)
    {
        $this->newData = $newData;
        $this->oldData = $oldData;
    }
}
