<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\VariantAxisSet;

class VariantAxisSetTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnObjectFromAValidArray()
    {
        $variantAxes = VariantAxisSet::fromJson($variantAxisAttributes = ['size', 'color', 'material']);
        self::assertEquals($variantAxisAttributes, $variantAxes->getAxes());
    }

    /**
     * @test
     * @expectedException \SnowIO\AkeneoDataModel\AkeneoDataException
     */
    public function shouldThrowAnErrorIfTheNumberOfAxesIsGreaterThanFive()
    {
        VariantAxisSet::fromJson($variantAxisAttributes = ['size', 'color', 'material', 'density', 'viscosity', 'width']);
    }
}