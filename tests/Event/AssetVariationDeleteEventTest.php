<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\Event\AssetVariationDeletedEvent;

class AssetVariationDeleteEventTest extends TestCase
{
    /** @test */
    public function shouldCreateObjectFromArray()
    {
        $assetVariation = AssetVariationDeletedEvent::fromJson(AssetVariationDataTest::getAssetVariationData());
        self::assertEquals("av17821_1", $assetVariation->getAssetCode());
        self::assertNotNull($assetVariation->getPreviousAssetVariation());
    }
}