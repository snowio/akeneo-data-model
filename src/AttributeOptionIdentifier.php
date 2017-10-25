<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class AttributeOptionIdentifier
{
    public static function of(string $attributeCode, string $optionCode): self
    {
        return new self($attributeCode, $optionCode);
    }

    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    public function getOptionCode(): string
    {
        return $this->optionCode;
    }

    public function toString(): string
    {
        return "{$this->attributeCode}_{$this->optionCode}";
    }

    private $attributeCode;
    private $optionCode;

    private function __construct(string $attributeCode, string $optionCode)
    {
        $this->attributeCode = $attributeCode;
        $this->optionCode = $optionCode;
    }
}
