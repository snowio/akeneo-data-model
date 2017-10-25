<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class AttributeOptionSet implements \IteratorAggregate
{
    public static function create(): self
    {
        return new self([]);
    }

    public function getOption(AttributeOptionIdentifier $identifier): ?AttributeOption
    {
        return $this->options[$identifier->toString()] ?? null;
    }

    public function getOptionLabel(AttributeOptionIdentifier $identifier, string $locale): ?string
    {
        if ($option = $this->getOption($identifier)) {
            return $option->getLabel($locale);
        }
        return null;
    }

    public function getOptionLabels(AttributeOptionIdentifier $identifier): InternationalizedString
    {
        $option = $this->getOption($identifier);
        return $option ? $option->getLabels() : InternationalizedString::create();
    }

    public function merge(self $attributeOptionSet): self
    {
        $options = \array_merge($this->options, $attributeOptionSet->options);
        return new self($options);
    }

    public static function fromJson(array $json): self
    {
        $options = [];
        foreach ($json['localizations'] ?? [] as $locale => $localizationJson) {
            foreach ($localizationJson['attribute_option_labels'] ?? [] as $attributeCode => $labelOrLabels) {
                $optionCodeOrCodes = $localizationJson['attribute_values'][$attributeCode] ?? $json['attribute_values'][$attributeCode] ?? null;
                if (\is_array($optionCodeOrCodes)) {
                    if (!\is_array($labelOrLabels) || \count($optionCodeOrCodes) != \count($labelOrLabels)) {
                        throw new AkeneoDataException;
                    }
                    $labels = \array_combine($optionCodeOrCodes, $labelOrLabels);
                    foreach ($labels as $optionCode => $label) {
                        $optionIdentifier = AttributeOptionIdentifier::of($attributeCode, $optionCode);
                        $option = $options[$optionIdentifier->toString()] ?? AttributeOption::of($optionIdentifier);
                        if ($label !== null) {
                            $options[$optionIdentifier->toString()] = $option->withLabel(LocalizedString::of($label, $locale));
                        }
                    }
                } elseif ($optionCodeOrCodes !== null) {
                    if (\is_array($labelOrLabels)) {
                        throw new AkeneoDataException;
                    }
                    $optionIdentifier = AttributeOptionIdentifier::of($attributeCode, $optionCodeOrCodes);
                    $option = $options[$optionIdentifier->toString()] ?? AttributeOption::of($optionIdentifier);
                    if ($labelOrLabels !== null) {
                        $options[$optionIdentifier->toString()] = $option->withLabel(LocalizedString::of($labelOrLabels, $locale));
                    }
                }
            }
        }
        return new self($options);
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->options as $option) {
            yield $option;
        }
    }

    /** @var AttributeOption[] */
    private $options;

    private function __construct(array $options)
    {
        $this->options = $options;
    }
}
