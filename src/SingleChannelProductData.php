<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelProductData extends SingleChannelItemData
{
    public static function fromJson(array $json): self
    {
        /** @var static $productData */
        $productData = parent::fromJson($json);
        $productData->properties = ProductProperties::fromJson($json);
        return $productData;
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
