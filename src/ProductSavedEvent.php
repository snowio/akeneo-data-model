<?php
namespace SnowIO\AkeneoDataModel;

class ProductSavedEvent
{
    public static function fromJson(array $json): self
    {
        $oldData = isset($json['old']) ? SingleChannelProductData::fromJson($json['old']) : null;
        $newData = SingleChannelProductData::fromJson($json['new']);
        return new self($newData, $oldData);
    }

    public function getSku(): string
    {
        return $this->newData->getSku();
    }

    public function getChannel(): string
    {
        return $this->newData->getChannel();
    }

    public function getNewData(): SingleChannelProductData
    {
        return $this->newData;
    }

    public function getOldData(): ?SingleChannelProductData
    {
        return $this->oldData;
    }

    private $newData;
    private $oldData;

    private function __construct(SingleChannelProductData $newData, SingleChannelProductData $oldData = null)
    {
        $this->newData = $newData;
        $this->oldData = $oldData;
    }
}
