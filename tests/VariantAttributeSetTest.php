<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\VariantAttributeSet;

class VariantAttributeSetTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnObjectFromAnArray()
    {
        $variantAttributes = VariantAttributeSet::fromJson(
            $variantAttributeList = ['sku', 'price', 'description', 'image_set']
        );

        self::assertEquals($variantAttributeList, $variantAttributes->getAttributes());
    }
}