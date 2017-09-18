<?php
namespace SnowIO\AkeneoDataModel;

class VariantGroupProperties
{
    public static function fromJson(array $json): VariantGroupProperties
    {
        $properties = new self;
        $properties->code = $json['code'];
        $properties->axis = \is_array($json['axis']) ? $json['axis'] : \explode(',', $json['axis']);
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

    private $code;
    private $axis;

    private function __construct()
    {

    }
}
