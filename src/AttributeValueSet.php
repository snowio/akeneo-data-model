<?php
namespace SnowIO\AkeneoDataModel;

class AttributeValueSet implements \IteratorAggregate
{
    public static function empty(): self
    {
        return new self([]);
    }

    public static function fromJson(string $channel, array $json): self
    {
        $attributeValues = [];
        foreach (self::convertMultiScopeJsonToAttributeValues($channel, $json) as $attributeValue) {
            $valueIdentifier = $attributeValue->getIdentifier()->toString();
            $attributeValues[$valueIdentifier] = $attributeValue;
        }
        return new AttributeValueSet($attributeValues);
    }

    public function getValue(AttributeValueIdentifier $identifier)
    {
        if ($attributeValue = $this->getAttributeValue($identifier)) {
            return $attributeValue->getValue();
        }
    }

    public function getValues(Scope $scope): array
    {
        $values = [];
        foreach ($this->attributeValues as $attributeValue) {
            if ($attributeValue->getScope()->equals($scope)) {
                $values[$attributeValue->getAttributeCode()] = $attributeValue->getValue();
            }
        }
        return $values;
    }

    public function getAttributeValue(AttributeValueIdentifier $identifier): ?AttributeValue
    {
        return $this->attributeValues[$identifier->toString()] ?? null;
    }

    public function filter(callable $predicate): self
    {
        $attributeValues = \array_filter($this->attributeValues, $predicate);
        return new self($attributeValues);
    }

    public function filterByScope(Scope $scope): self
    {
        return $this->filter(function (AttributeValue $attributeValue) use ($scope) {
            return $attributeValue->getScope()->equals($scope);
        });
    }

    public function add(self $attributeValueSet): self
    {
        if (
            \array_intersect_key($this->attributeValues, $attributeValueSet->attributeValues) !== []
            || \array_intersect_key($attributeValueSet->attributeValues, $this->attributeValues) !== []
        ) {
            throw new \Exception();
        }

        $mergedValues = \array_merge($this->attributeValues, $attributeValueSet->attributeValues);
        return new self($mergedValues);
    }

    public function isEmpty(): bool
    {
        return empty($this->attributeValues);
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->attributeValues as $attributeValue) {
            yield $attributeValue;
        }
    }

    /** @var AttributeValue[] */
    private $attributeValues;

    private function __construct(array $attributeValues)
    {
        $this->attributeValues = $attributeValues;
    }

    private static function convertMultiScopeJsonToAttributeValues(string $channel, array $json)
    {
        $scope = Scope::ofChannel($channel);
        yield from self::convertSingleScopeJsonToAttributeValues($scope, $json['attribute_values'] ?? []);
        foreach ($json['localizations'] ?? [] as $locale => $localeJson) {
            $localeScope = $scope->withLocale($locale);
            yield from self::convertSingleScopeJsonToAttributeValues($localeScope, $localeJson['attribute_values'] ?? []);
        }
    }

    private static function convertSingleScopeJsonToAttributeValues(Scope $scope, array $json)
    {
        foreach ($json as $attributeCode => $value) {
            if (\is_array($value) && \is_string(\key($value))) {
                $sanitizedValue = PriceSet::fromJson($value);
            } else {
                $sanitizedValue = $value === '' ? null : $value;
            }
            $valueIdentifier = AttributeValueIdentifier::of($attributeCode, $scope);
            yield AttributeValue::of($valueIdentifier, $sanitizedValue);
        }
    }
}
