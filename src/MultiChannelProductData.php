<?php
namespace SnowIO\AkeneoDataModel;

class MultiChannelProductData extends MultiChannelItemData
{
    public static function of(ProductProperties $properties): self
    {
        /** @var static $multiChannelData */
        $multiChannelData = parent::create();
        $multiChannelData->properties = $properties;
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

    /** @var ProductProperties */
    private $properties;
}
