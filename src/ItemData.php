<?php
namespace SnowIO\AkeneoDataModel;

abstract class ItemData
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

    /**
     * @return static
     */
    protected static function fromJson(array $json)
    {
        $itemData = new static;
        $itemData->channel = $json['channel'];
        $itemData->attributeValues = AttributeValueSet::fromJson($json['channel'], $json);
        $itemData->attributeOptions = AttributeOptionSet::fromJson($json);
        return $itemData;
    }

    private $channel;
    private $attributeValues;
    private $attributeOptions;

    private function __construct()
    {

    }
}
