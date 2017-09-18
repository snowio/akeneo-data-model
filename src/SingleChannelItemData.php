<?php
namespace SnowIO\AkeneoDataModel;

abstract class SingleChannelItemData
{
    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getAttributeValues(): AttributeValueSet
    {
        return $this->attributeValues;
    }

    public function getAttributeOptions(): AttributeOptionSet
    {
        return $this->attributeOptions;
    }

    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * @return static
     */
    protected static function fromJson(array $json)
    {
        $itemData = new static;
        $itemData->channel = $json['channel'];
        $itemData->attributeValues = AttributeValueSet::fromJson($json['channel'], $json);
        $itemData->attributeOptions = AttributeOptionSet::fromJson($json);
        $itemData->timestamp = $json['@timestamp'];
        return $itemData;
    }

    private $channel;
    private $attributeValues;
    private $attributeOptions;
    private $timestamp;

    private function __construct()
    {

    }
}
