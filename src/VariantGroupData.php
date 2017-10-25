<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class VariantGroupData extends ItemData
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
