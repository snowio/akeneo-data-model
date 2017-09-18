<?php
namespace SnowIO\AkeneoDataModel;

class MultiChannelProductData
{
    public static function of(
        ProductProperties $properties,
        AttributeValueSet $attributeValues,
        AttributeOptionSet $attributeOptions,
        string $mostRecentlyUpdatedChannel
    ): self {
        $multiChannelData = new self;
        $multiChannelData->properties = $properties;
        $multiChannelData->attributeValues = $attributeValues;
        $multiChannelData->attributeOptions = $attributeOptions;
        $multiChannelData->mostRecentlyUpdatedChannel = $mostRecentlyUpdatedChannel;
        return $multiChannelData;
    }

    public function getSku(): string
    {
        return $this->properties->getSku();
    }

    public function getProperties(): ProductProperties
    {
        return $this->properties;
    }

    public function getAttributeValue(AttributeValueIdentifier $identifier)
    {
        return $this->attributeValues->getValue($identifier);
    }

    public function getAttributeValues(): AttributeValueSet
    {
        return $this->attributeValues;
    }

    public function getAttributeOptions(): AttributeOptionSet
    {
        return $this->attributeOptions;
    }

    public function getMostRecentlyUpdatedChannel(): string
    {
        return $this->mostRecentlyUpdatedChannel;
    }

    public function getAttributeValuesForMostRecentlyUpdatedChannel(): AttributeValueSet
    {
        return $this->attributeValues->filter(function (AttributeValue $attributeValue) {
            return $attributeValue->getScope()->getChannel() === $this->mostRecentlyUpdatedChannel;
        });
    }

    /** @var ProductProperties */
    private $properties;
    /** @var AttributeValueSet */
    private $attributeValues;
    /** @var AttributeOptionSet */
    private $attributeOptions;
    private $mostRecentlyUpdatedChannel;

    private function __construct()
    {

    }
}
