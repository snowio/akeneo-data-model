<?php
namespace SnowIO\AkeneoDataModel;

class AttributeOption
{
    public static function of(AttributeOptionIdentifier $identifier): self
    {
        $option = new self;
        $option->identifier = $identifier;
        return $option;
    }

    public function getAttributeCode(): string
    {
        return $this->identifier->getAttributeCode();
    }

    public function getOptionCode(): string
    {
        return $this->identifier->getOptionCode();
    }

    public function getIdentifier(): AttributeOptionIdentifier
    {
        return $this->identifier;
    }

    public function withLabel(string $label, string $locale): self
    {
        $result = clone $this;
        $result->labels[$locale] = $label;
        return $result;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    /** @var AttributeOptionIdentifier */
    private $identifier;
    private $labels = [];

    private function __construct()
    {

    }
}
