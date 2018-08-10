<?php

use SnowIO\AkeneoDataModel\FamilyVariantData;

class FamilyVariantDataTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldCreateValidObjectFromArray()
    {
        $familyVariant = FamilyVariantData::fromJson($input = self::getFamilyVariantData());
        self::assertEquals($input['code'], $familyVariant->getCode());
        self::assertEquals($input['family'], $familyVariant->getFamily());
        self::assertEquals($input['labels']['en_GB'], $familyVariant->getLabel('en_GB'));
        self::assertEquals($input['labels']['fr_FR'], $familyVariant->getLabel('fr_FR'));
        $axes = $familyVariant->getVariantAxes();
        $variantAttributes = $familyVariant->getVariantAttributes();
        self::assertEquals($input['variant_axes']["1"], $axes->getFirst()->getAxes());
        self::assertEquals($input['variant_axes']["2"], $axes->getSecond()->getAxes());
        self::assertEquals($input['variant_attributes']["1"], $variantAttributes->getFirst()->getAttributes());
        self::assertEquals($input['variant_attributes']["2"], $variantAttributes->getSecond()->getAttributes());
    }

    public static function getFamilyVariantData()
    {
        return [
            'code' => 'test',
            'family' => 'main',
            'labels' => [
                'en_GB' => 'foo',
                'fr_FR' => 'bar'
            ],
            'variant_axes' => [
                "1" => ["foo", "bar", "x", "y"],
                "2" => ["v", "g", "l"]
            ],
            'variant_attributes' => [
                "1" => ["x", "y", "z", "l", "m", "n"],
                "2" => ["a", "b", "c", "d", "e", "f"],
            ],
            '@timestamp' => 0
        ];
    }
}