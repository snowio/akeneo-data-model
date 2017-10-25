<?php
namespace SnowIO\AkeneoDataModel;

class AttributeGroup
{
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

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public static function fromJson(array $json): self
    {
        $attributeGroup = new self;
        $attributeGroup->code = $json['code'];
        $attributeGroup->labels = InternationalizedString::fromJson($json['labels']);
        $attributeGroup->sortOrder = (int)$json['sort_order'];
        return $attributeGroup;
    }

    private $code;
    /** @var InternationalizedString */
    private $labels;
    private $sortOrder;

    private function __construct()
    {
    }
}
