<?php
namespace SnowIO\AkeneoDataModel;

class MultiChannelVariantGroupData extends MultiChannelItemData
{
    public static function of(VariantGroupProperties $properties): self
    {
        /** @var static $multiChannelData */
        $multiChannelData = parent::create();
        $multiChannelData->properties = $properties;
        return $multiChannelData;
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
