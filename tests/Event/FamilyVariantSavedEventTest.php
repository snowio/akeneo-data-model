<?php

use PHPUnit\Framework\TestCase;
use SnowIO\AkeneoDataModel\Event\FamilyVariantSavedEvent;

class FamilyVariantSavedEventTest extends TestCase
{

    /** @test */
    public function shouldCreateAnObjectFromAnArrayThatIsNew()
    {
        $familyVariantSavedEvent = FamilyVariantSavedEvent::fromJson(self::getNewFamilyVariant());
        self::assertEquals("test", $familyVariantSavedEvent->getFamilyVariantCode());
        self::assertEquals("main", $familyVariantSavedEvent->getFamily());
        self::assertNotNull($familyVariantSavedEvent->getCurrentFamilyVariantData());
        self::assertNull($familyVariantSavedEvent->getPreviousFamilyVariantData());
    }

    /** @test */
    public function shouldCreateAnObjectFromAnArrayThatIsUpdated()
    {
        $familyVariantSavedEvent = FamilyVariantSavedEvent::fromJson(self::getUpdatedFamilyVariant());
        self::assertNotNull($familyVariantSavedEvent->getPreviousFamilyVariantData());
    }

    private static function getNewFamilyVariant()
    {
        return [
            "code"=> "test",
            "old" => null,
            "new" => FamilyVariantDataTest::getFamilyVariantData()
        ];
    }

    private static function getUpdatedFamilyVariant()
    {
        return [
            "code"=> "test",
            "old" => FamilyVariantDataTest::getFamilyVariantData(),
            "new" => FamilyVariantDataTest::getFamilyVariantData()
        ];
    }
}