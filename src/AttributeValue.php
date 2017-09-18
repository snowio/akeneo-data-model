<?php
namespace SnowIO\AkeneoDataModel;

class AttributeValue
{
    public static function of(AttributeValueIdentifier $identifier, $value): self
    {
        return new self($identifier, $value);
    }

    public function getAttributeCode(): string
    {
        return $this->identifier->getAttributeCode();
    }

    public function getIdentifier(): AttributeValueIdentifier
    {
        return $this->identifier;
    }

    public function withScope(Scope $scope): self
    {
        $attributeValue = clone $this;
        $attributeValue->identifier = AttributeValueIdentifier::of($this->getAttributeCode(), $scope);
        return $attributeValue;
    }

    public function getScope(): Scope
    {
        return $this->identifier->getScope();
    }

    public function getValue()
    {
        return $this->value;
    }

    private $identifier;
    private $value;

    private function __construct(AttributeValueIdentifier $identifier, $value)
    {
        $this->identifier = $identifier;
        $this->value = $value;
    }
}
