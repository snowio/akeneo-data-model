<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class FamilyData
{
    public function getCode(): string
    {
       return $this->code;
    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function getAttributes(): FamilyAttributeSet
    {
        return $this->attributes;
    }

    public function getLabels(): InternationalizedString
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels->getValue($locale);
    }

    public static function fromJson(array $json): self
    {
        $family = new self;
        $family->groups = array_map(function (array $attributeGroup) {
            return AttributeGroup::fromJson($attributeGroup);
        }, $json['attribute_groups']);
        $family->attributes = FamilyAttributeSet::fromJson($json['attribute_groups']);
        $family->labels = InternationalizedString::fromJson($json['labels']);
        return $family;
    }

    private $code;
    private $groups;
    private $attributes;
    /** @var InternationalizedString */
    private $labels;

    private function __construct()
    {

    }
}
