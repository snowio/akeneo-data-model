<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelVariantGroupData extends SingleChannelItemData
{
    public static function fromJson(array $json): self
    {
        /** @var static $variantGroupData */
        $variantGroupData = parent::fromJson($json);
        $variantGroupData->properties = VariantGroupProperties::fromJson($json);
        return $variantGroupData;
    }

    public function getCode(): string
    {
        return $this->properties->getCode();
    }

    public function getProperties(): VariantGroupProperties
    {
        return $this->properties;
    }

    /** @var VariantGroupProperties */
    private $properties;
}