<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\Event\ProductModelDeletedEvent;

class ProductModelDeletedEventTest extends TestCase
{
    /** @test */
    public function shouldCreateObjectFromArray()
    {
        $productModelDeletedEvent = ProductModelDeletedEvent::fromJson(ProductModelDataTest::getProductModelJson());
        self::assertEquals('test-channel', $productModelDeletedEvent->getChannel());
        self::assertNotNull($productModelDeletedEvent->getPreviousProductModelData());
        self::assertEquals('pm1234', $productModelDeletedEvent->getProductModelCode());
    }
}