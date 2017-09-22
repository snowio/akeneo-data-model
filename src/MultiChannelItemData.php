<?php
namespace SnowIO\AkeneoDataModel;

abstract class MultiChannelItemData
{
    public function hasDataForChannel(string $channel): bool
    {
        /** @var AttributeValue $attributeValue */
        foreach ($this->attributeValues as $attributeValue) {
            if ($attributeValue->getScope()->getChannel() === $channel) {
                return true;
            }
        }
        return false;
    }

    public function getAttributeValue(AttributeValueIdentifier $identifier)
    {
        return $this->attributeValues->getValue($identifier);
    }

    public function getAttributeValues(): AttributeValueSet
    {
        return $this->attributeValues;
    }

    /**
     * @return static
     */
    public function withAttributeValues(AttributeValueSet $attributeValues)
    {
        $copy = clone $this;
        $copy->attributeValues = $attributeValues;
        return $copy;
    }

    public function getAttributeOptions(): AttributeOptionSet
    {
        return $this->attributeOptions;
    }

    /**
     * @return static
     */
    public function withAttributeOptions(AttributeOptionSet $attributeOptions)
    {
        $copy = clone $this;
        $copy->attributeOptions = $attributeOptions;
        return $copy;
    }

    /**
     * @return static
     */
    protected static function create()
    {
        $multiChannelData = new static;
        $multiChannelData->attributeValues = AttributeValueSet::empty();
        $multiChannelData->attributeOptions = AttributeOptionSet::empty();
        return $multiChannelData;
    }

    /** @var AttributeValueSet */
    private $attributeValues;
    /** @var AttributeOptionSet */
    private $attributeOptions;

    private function __construct()
    {

    }
}
