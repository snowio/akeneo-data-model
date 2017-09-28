<?php
namespace SnowIO\AkeneoDataModel;

class AttributeGroup
{
    public function getCode(): string
    {
        return $this->code;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public static function fromJson(array $json): self
    {
        $attributeGroup = new self;
        $attributeGroup->code = $json['code'];
        $attributeGroup->labels = $json['labels'];
        $attributeGroup->sortOrder = $json['sort_order'];
        return $attributeGroup;
    }

    private $code;
    private $labels;
    private $sortOrder;

    private function __construct()
    {
    }
}