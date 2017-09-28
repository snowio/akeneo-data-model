<?php
namespace SnowIO\AkeneoDataModel;

class Family
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

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public static function fromJson(array $json): self
    {
        $family = new self;
        $family->groups = array_map(function (array $attributeGroup) {
            return AttributeGroup::fromJson($attributeGroup);
        }, $json['attribute_groups']);
        $family->attributes = FamilyAttributeSet::fromJson($json);
        $family->labels = $json['labels'];
        $family->timestamp = $json['@timestamp'];
        return $family;
    }

    private $code;
    private $groups;
    private $attributes;
    private $labels;
    private $timestamp;

    private function __construct()
    {

    }
}
