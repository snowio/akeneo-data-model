<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\PriceCollection;
use SnowIO\AkeneoDataModel\ProductModelData;
use SnowIO\AkeneoDataModel\ProductModelProperties;
use SnowIO\AkeneoDataModel\Scope;

class ProductModelDataTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnObjectGiveAValidArray()
    {
        $productModelData = ProductModelData::fromJson($productModel = self::getProductModelJson());
        $attributeValues = $productModelData->getAttributeValues();
        self::assertEquals('pm1234', $productModelData->getCode());
        self::assertEquals('test-channel', $productModelData->getChannel());
        self::assertEquals(self::getExpectedAttributeValuesJson(), $productModelData->getAttributeValues()->getValues(Scope::ofChannel('test-channel')));
        self::assertEquals(self::getLocalizedValuesJson(), $attributeValues->getValues(Scope::ofChannel('test-channel')->withLocale('en_GB')));
    }

    public static function getProductModelJson()
    {
        return [
            'channel' => 'test-channel',
            'code' => 'pm1234',
            'family_variant' => FamilyVariantDataTest::getFamilyVariantData(),
            'categories' => ['test_categories'],
            'parent' => 'test-parent',
            'attribute_values' => self::getAttributeValueJson(),
            'localizations' => [
                'en_GB' => [
                    "attribute_values" => self::getLocalizedValuesJson()
                ]
            ],
            "@timestamp" => 0
        ];
    }

    private static function getLocalizedValuesJson()
    {
        return [
            "short_description" => "This is a test",
            "title" => "Koppel Vase"
        ];
    }

    private static function getAttributeValueJson()
    {
        return [
            "code" => "koppel_vase",
            "brand" => null,
            "buying_member" => null,
            "colour_group" => [],
            "direct_delivery" => "0",
            "group_giftable" => "0",
            "hidden" => "0",
            "is_cash_gift" => "0",
            "is_on_outlet" => "0",
            "list_price" => [
                "GBP" => null
            ],
            "mpn" => null,
            "photos" => null,
            "price_chargeable" => [
                "GBP" => null
            ],
            "product_member" => null,
            "product_status" => null,
            "sold_out" => "0",
            "supplier_pack_size" => null,
            "vat_code" => null,
        ];
    }

    private static function getExpectedAttributeValuesJson()
    {
        return [
            "code" => "koppel_vase",
            "brand" => null,
            "buying_member" => null,
            "colour_group" => [],
            "direct_delivery" => "0",
            "group_giftable" => "0",
            "hidden" => "0",
            "is_cash_gift" => "0",
            "is_on_outlet" => "0",
            "list_price" => PriceCollection::fromJson(["GBP" => null]),
            "mpn" => null,
            "photos" => null,
            "price_chargeable" => PriceCollection::fromJson(["GBP" => null]),
            "product_member" => null,
            "product_status" => null,
            "sold_out" => "0",
            "supplier_pack_size" => null,
            "vat_code" => null
        ];
    }
}