<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\Event\AssetVariationSavedEvent;

class AssetVariationSavedEventTest extends TestCase
{
    /** @test */
    public function shouldCreateAnObjectFromAnArrayThatIsNew()
    {
        $assetVariationSavedEvent = AssetVariationSavedEvent::fromJson(self::getNewFamilyVariant());
        self::assertEquals("av17821_1", $assetVariationSavedEvent->getAssetCode());
        self::assertEquals("test-channel", $assetVariationSavedEvent->getChannel());
        self::assertNotNull($assetVariationSavedEvent->getCurrentAssetVariationData());
        self::assertNull($assetVariationSavedEvent->getPreviousAssetVariationData());
    }

    /** @test */
    public function shouldCreateAnObjectFromAnArrayThatIsUpdated()
    {
        $AssetVariationSavedEvent = AssetVariationSavedEvent::fromJson(self::getUpdatedFamilyVariant());
        self::assertNotNull($AssetVariationSavedEvent->getPreviousAssetVariationData());
    }

    private static function getNewFamilyVariant()
    {
        return [
            "code"=> "test",
            "old" => null,
            "new" => AssetVariationDataTest::getAssetVariationData()
        ];
    }

    private static function getUpdatedFamilyVariant()
    {
        return [
            "code"=> "test",
            "old" => AssetVariationDataTest::getAssetVariationData(),
            "new" => AssetVariationDataTest::getAssetVariationData()
        ];
    }
}