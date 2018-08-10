<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\CategoryPath;
use SnowIO\AkeneoDataModel\FamilyVariantData;

class ProductModelPropertiesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnObjectFromAValidArray()
    {
        $productModelProperties = \SnowIO\AkeneoDataModel\ProductModelProperties::fromJson($productModelPropertyData = [
            'code' => 'foo-bar',
            'categories' => [
                'master_men_blazers'
            ],
            'family_variant' => FamilyVariantDataTest::getFamilyVariantData(),
            'parent' => 'master_blazers'
        ]);

        self::assertNotNull($productModelProperties->getCategories());
        self::assertNotNull($productModelProperties->getFamilyVariant());
        self::assertEquals('foo-bar', $productModelProperties->getCode());
        self::assertEquals('master_blazers', $productModelProperties->getParent());
    }
}