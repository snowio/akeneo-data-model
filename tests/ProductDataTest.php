<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\ProductData;

class ProductDataTest extends TestCase
{
    /** @test **/
    public function shouldCreateAnObjectFromAnArray()
    {
        $productData = ProductData::fromJson(self::getProductData());
        self::assertEquals("test", $productData->getChannel());
        self::assertEquals("foo", $productData->getSku());
        self::assertEquals(0, count(iterator_to_array($productData->getAttributeOptions()->getIterator())));
        self::assertNotNull($productData->getAttributeValues());
    }

    public static function getProductData()
    {
        return [
            "channel" => "test",
            "sku" => "foo",
            "enabled" => "1",
            "parent" => "pm1234",
            "family" => "main",
            "groups" => ["test1", "test2"],
            "categories" => [["root1", "child1"], ["root2", "child2"]],
            "attribute_values" => [
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
            ],
            "localizations" => [
                "en_GB" => [
                    "attribute_values" => [
                        "short_description" => "This is a test",
                        "title" => "Koppel Vase"
                    ]
                ]
            ]
        ];
    }


}