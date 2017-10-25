<?php
namespace SnowIO\AkeneoDataModel;

class VariantGroupProperties
{
    public static function fromJson(array $json): VariantGroupProperties
    {
        $properties = new self;
        $properties->code = $json['code'];
        $properties->axis = \is_array($json['axis']) ? $json['axis'] : \explode(',', $json['axis']);
        $labels = \array_map(function (array $localization) {
            return $localization['label'] === '' ? null : $localization['label'];
        }, $json['localizations'] ?? []);
        $properties->labels = InternationalizedString::fromJson($labels);
        return $properties;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string[]
     */
    public function getAxis(): array
    {
        return $this->axis;
    }

    public function getLabels(): InternationalizedString
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels->getValue($locale);
    }

    private $code;
    private $axis;
    /** @var InternationalizedString */
    private $labels;

    private function __construct()
    {

    }
}
