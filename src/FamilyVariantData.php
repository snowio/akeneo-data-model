<?php

namespace SnowIO\AkeneoDataModel;

class FamilyVariantData
{
    public function getCode(): string
    {
        return $this->code;
    }

    public function getFamily(): string
    {
        return $this->family;
    }

    public function getLabels(): InternationalizedString
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels->getValue($locale) ?? null;
    }

    public function getVariantAxes(): VariantAxesPair
    {
        return $this->variantAxes;
    }

    public function getVariantAttributes(): VariantAttributesPair
    {
        return $this->variantAttributes;
    }

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->labels = empty($json['labels']) ?
            InternationalizedString::create() :
            InternationalizedString::fromJson($json['labels']);

        $result->family = $json['family'];
        $result->code = $json['code'];

        $result->variantAxes = VariantAxesPair::of(
            VariantAxisSet::fromJson($json['variant_axes']["1"] ?? []),
            VariantAxisSet::fromJson($json['variant_axes']["2"] ?? [])
        );

        $result->variantAttributes = VariantAttributesPair::of(
            VariantAttributeSet::fromJson($json['variant_attributes']["1"] ?? []),
            VariantAttributeSet::fromJson($json['variant_attributes']["2"] ?? [])
        );

        return $result;
    }

    private $code;
    private $family;
    /** @var  InternationalizedString */
    private $labels;
    private $variantAxes;
    private $variantAttributes;

    private function __construct()
    {

    }
}