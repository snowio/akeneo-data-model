<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class ProductProperties
{
    public static function of(string $sku): self
    {
        $properties = new self;
        $properties->sku = $sku;
        $properties->enabled = false;
        $properties->groups = [];
        $properties->parent = [];
        $properties->categories = CategoryPathSet::create();
        return $properties;
    }

    public static function fromJson(array $json): self
    {
        $properties = new self;
        $properties->sku = $json['sku'];
        if (($json['parent'] ?? '') === '') {
            $properties->parent = null;
        } else {
            $properties->parent = $json['parent'];
        }
        $properties->enabled = (bool)$json['enabled'];
        $properties->family = $json['family'];
        $properties->groups = $json['groups'];
        $properties->categories = CategoryPathSet::fromJson($json['categories']);
        return $properties;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function getParent(): ?string
    {
        return $this->parent ?? null;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function getCategories(): CategoryPathSet
    {
        return $this->categories;
    }

    private $sku;
    private $parent;
    private $groups;
    private $enabled;
    private $family;
    private $categories;

    private function __construct()
    {

    }
}
