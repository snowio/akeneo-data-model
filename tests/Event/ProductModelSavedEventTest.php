<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\Event\ProductModelSavedEvent;

class ProductModelSavedEventTest extends TestCase
{
    /** @test */
    public function shouldCreateObjectFromArrayGivenItsNew()
    {
        $productModelSavedEvent = ProductModelSavedEvent::fromJson(self::getNewProductModelSavedEventJson());
        self::assertEquals("test-channel", $productModelSavedEvent->getChannel());
        self::assertEquals("pm1234", $productModelSavedEvent->getProductModelCode());
        self::assertNotNull($productModelSavedEvent->getCurrentProductModelData());
        self::assertFalse($productModelSavedEvent->hasPreviousProductModelData());
    }

    public function shouldCreateObjectFromArrayGivenItAnUpdate()
    {
        $productModelSavedEvent = ProductModelSavedEvent::fromJson(self::getUpdateProductModelSavedEventJson());
        self::assertTrue($productModelSavedEvent->hasPreviousProductModelData());
    }

    private static function getNewProductModelSavedEventJson()
    {
        return [
            "old" => null,
            "new" => ProductModelDataTest::getProductModelJson(),
            "code" => "pm1234",
            "channel" => "test-channel",
        ];
    }

    private static function getUpdateProductModelSavedEventJson()
    {
        return [
            "old" => ProductModelDataTest::getProductModelJson(),
            "new" => ProductModelDataTest::getProductModelJson(),
            "code" => "pm1234",
            "channel" => "test-channel",
        ];
    }
}