<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelProductData
{
    public static function fromJson(array $json): self
    {
        $data = new self;
        $data->channel = $json['channel'];
        $data->properties = ProductProperties::fromJson($json);
        $data->attributeValues = AttributeValueSet::fromJson($json['channel'], $json);
        $data->attributeOptions = AttributeOptionSet::fromJson($json);
        $data->timestamp = $json['@timestamp'];
        return $data;
    }

    public function getSku(): string
    {
        return $this->properties->getSku();
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getProperties(): ProductProperties
    {
        return $this->properties;
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

    private $channel;
    /** @var ProductProperties */
    private $properties;
    private $attributeValues;
    private $attributeOptions;
    private $timestamp;

    private function __construct()
    {

    }
}
