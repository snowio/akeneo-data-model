<?php
namespace SnowIO\AkeneoDataModel;

class ProductProperties
{
    public static function of(string $sku): self
    {
        $properties = new self;
        $properties->sku = $sku;
        $properties->enabled = false;
        $properties->variantGroups = [];
        $properties->categories = CategoryReferenceSet::empty();
        return $properties;
    }

    public static function fromJson(array $json): self
    {
        $properties = new self;
        $properties->sku = $json['sku'];
        if (($json['group'] ?? '') === '') {
            $properties->variantGroups = [];
        } else {
            $properties->variantGroups = \explode(',', $json['group']);
        }
        $properties->enabled = (bool)$json['enabled'];
        $properties->family = $json['family'];
        $properties->categories = CategoryReferenceSet::fromJson($json['categories']);
        return $properties;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string[]
     */
    public function getVariantGroups(): array
    {
        return $this->variantGroups;
    }

    public function getVariantGroup(): ?string
    {
        return $this->variantGroups[0] ?? null;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function getCategories(): CategoryReferenceSet
    {
        return $this->categories;
    }

    private $sku;
    private $variantGroups;
    private $enabled;
    private $family;
    private $categories;

    private function __construct()
    {

    }
}
