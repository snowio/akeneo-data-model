<?php
namespace SnowIO\AkeneoDataModel;

class VariantGroupProperties
{
    public static function fromJson(array $json): VariantGroupProperties
    {
        $properties = new self;
        $properties->code = $json['code'];
        $properties->axis = \is_array($json['axis']) ? $json['axis'] : \explode(',', $json['axis']);
        $properties->labels = \array_map(function (array $localization) {
            return $localization['label'] === '' ? null : $localization['label'];
        }, $json['localizations'] ?? []);
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

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    private $code;
    private $axis;
    private $labels;

    private function __construct()
    {

    }
}
