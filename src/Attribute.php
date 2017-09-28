<?php
namespace SnowIO\AkeneoDataModel;

class Attribute
{
    const TYPE_IDENTIFIER = 'pim_catalog_identifier';
    const TYPE_SIMPLE_SELECT = 'pim_catalog_simpleselect';
    const TYPE_BOOLEAN = 'pim_catalog_boolean';
    const TYPE_NUMBER = 'pim_catalog_number';
    const TYPE_PRICE_COLLECTION = 'pim_catalog_price_collection';
    const TYPE_DATE = 'pim_catalog_date';
    const TYPE_TEXT = 'pim_catalog_text';
    const TYPE_TEXTAREA = 'pim_catalog_textarea';
    const TYPE_MULTISELECT = 'pim_catalog_multiselect';

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function isLocalizable(): bool
    {
        return $this->localizable;
    }

    public function isScopable(): bool
    {
        return $this->scopable;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public static function fromJson(array $json): self
    {
        $attribute = new self();
        $attribute->code = $json['code'];
        $attribute->type = $json['type'];
        $attribute->localizable = $json['localizable'];
        $attribute->scopable = $json['scopable'];
        $attribute->sortOrder = $json['sort_order'];
        $attribute->labels = $json['labels'];
        $attribute->group = $json['group'];
        $attribute->timestamp = $json['@timestamp'];
        return $attribute;
    }

    private $code;
    private $type;
    private $labels = [];
    private $localizable;
    private $scopable;
    private $sortOrder;
    private $group;
    private $timestamp;

    private function __construct()
    {

    }
}
