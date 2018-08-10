<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class ProductModelData extends ItemData
{
    public static function fromJson(array $json): self
    {
        /** @var static $productModel */
        $productModel = parent::fromJson($json);
        $productModel->properties = ProductModelProperties::fromJson($json);
        return $productModel;
    }

    public function getCode(): string
    {
        return $this->properties->getCode();
    }

    public function getProperties(): ProductModelProperties
    {
        return $this->properties;
    }

    public function equals(): bool
    {

    }


    /** @var ProductModelProperties */
    private $properties;
}
