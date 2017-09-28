<?php
namespace SnowIO\AkeneoDataModel;

class FamilyAttributeSet implements \IteratorAggregate
{
    public static function empty(): self
    {
        return new self([]);
    }

    public function getAttribute(string $code): ?FamilyAttributeData
    {
        return $this->attributes[$code] ?? null;
    }

    public function filterByGroup(string $groupCode): self
    {
        return $this->filter(function (FamilyAttributeData $familyAttributeData) use ($groupCode) {
            return $familyAttributeData->getGroup() === $groupCode;
        });
    }

    public function filter(callable $predicate): self
    {
        $attributes = \array_filter($this->attributes, $predicate);
        return new self($attributes);
    }

    public function isEmpty(): bool
    {
        return empty($this->attributes);
    }

    public static function fromJson(array $json): self
    {
        $attributes = [];
        foreach ($json as $attributeGroupJson) {
            foreach ($attributeGroupJson['attributes'] as $attributeJson) {
                $attributeJson += ['group' => $attributeGroupJson['code']];
                $attributes[$attributeGroupJson['code']] = FamilyAttributeData::fromJson($attributeJson);
            }
        }

        return new self($attributes);
    }

    public function getIterator()
    {
        foreach ($this->attributes as $attribute) {
            yield $attribute;
        }
    }

    private $attributes;

    private function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
