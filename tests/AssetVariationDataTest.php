<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\AssetVariationData;

class AssetVariationDataTest extends TestCase
{
    /** @test */
    public function shouldCreateAnObjectFromAnArray()
    {
        $assetVariation = AssetVariationData::fromJson(self::getAssetVariationData());
        self::assertEquals("av17821_1", $assetVariation->getAsset());
        self::assertEquals("test-channel", $assetVariation->getChannel());
        self::assertEquals("en_GB", $assetVariation->getLocale());
        self::assertEquals("d/c/d/4/dcd484e7aefb840ce276aed0928a1c8e14240083_2554856_1.jpg", $assetVariation->getReferenceFile());
        self::assertEquals("3/e/8/4/3e84b92a245dacd49b0bfb1c1f45f5f91a8ccf7a_2554858_1_test-channel.jpg", $assetVariation->getVariationFile());

    }

    public static function getAssetVariationData()
    {
        return [
            "asset" => "av17821_1",
            "channel" => 'test-channel',
            "locale" => "en_GB",
            "reference_file" => "d/c/d/4/dcd484e7aefb840ce276aed0928a1c8e14240083_2554856_1.jpg",
            "variation_file" => "3/e/8/4/3e84b92a245dacd49b0bfb1c1f45f5f91a8ccf7a_2554858_1_test-channel.jpg",
            "@timestamp" => 0
        ];
    }
}