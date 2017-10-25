<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class AttributeValueIdentifier
{
    public static function of(string $attributeCode, Scope $scope): self
    {
        return new self($attributeCode, $scope);
    }

    public function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    public function getScope(): Scope
    {
        return $this->scope;
    }

    public function toString(): string
    {
        return \implode('-', [
            $this->attributeCode,
            $this->scope->getChannel(),
            $this->scope->getLocale(),
        ]);
    }

    private $attributeCode;
    private $scope;

    private function __construct(string $attributeCode, Scope $scope)
    {
        $this->attributeCode = $attributeCode;
        $this->scope = $scope;
    }
}
