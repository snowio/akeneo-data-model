<?php

namespace SnowIO\AkeneoDataModel;


class AssetVariationData
{

    public static function fromJson(array $json): self
    {
        $result = new self;
        $result->asset = $json['asset'];
        $result->channel = $json['channel'];
        $result->locale = $json['locale'];
        $result->referenceFile = $json['reference_file'];
        $result->variationFile = $json['variation_file'];
        return $result;
    }

    public function getAsset(): string
    {
        return $this->asset;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function getReferenceFile(): string
    {
        return $this->referenceFile;
    }

    public function getVariationFile(): ?string
    {
        return $this->variationFile;
    }

    private $asset;
    private $channel;
    private $locale;
    private $referenceFile;
    private $variationFile;

    private function __construct()
    {

    }
}