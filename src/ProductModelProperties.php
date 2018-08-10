<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class ProductModelProperties
{
    public static function fromJson(array $json): ProductModelProperties
    {
        $properties = new self;
        $properties->code = $json['code'];
        $properties->familyVariant = FamilyVariantData::fromJson($json['family_variant']);
        $properties->categories = CategoryPath::of($json['categories']);
        $properties->parent = $json['parent'];
        return $properties;
    }

    public function getCategories(): CategoryPath
    {
        return $this->categories;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLabels(): InternationalizedString
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels->getValue($locale);
    }

    public function getFamilyVariant(): FamilyVariantData
    {
        return $this->familyVariant;
    }

    public function getParent(): string
    {
        return $this->parent;
    }

    public function equals(): bool
    {

    }

    private $code;
    private $familyVariant;
    /** @var InternationalizedString */
    private $labels;
    private $categories;
    private $parent;

    private function __construct()
    {

    }
}
