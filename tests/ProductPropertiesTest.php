<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\ProductProperties;

class ProductPropertiesTest extends TestCase
{

    /** @test */
    public function shouldCreateObjectsArray()
    {
        $productProperties = ProductProperties::fromJson(self::getProductPropertiesAsJson());
        self::assertNotNull($productProperties->getCategories());
        self::assertEquals(true, $productProperties->getEnabled());
        self::assertEquals(["socks"], $productProperties->getGroups());
        self::assertEquals("main", $productProperties->getFamily());
        self::assertEquals("pm1234", $productProperties->getParent());
    }

    public function getProductPropertiesAsJson()
    {
        return [
            "sku" => "socks_1",
            "categories" => [["men's socks", "woolen"], ["men's attire", "footwear"]],
            "enabled" => 1,
            "family" => "main",
            "groups" => ["socks"],
            "parent" => "pm1234",
        ];
    }
}