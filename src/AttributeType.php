<?php
namespace SnowIO\AkeneoDataModel;

abstract class AttributeType
{
    const IDENTIFIER = 'pim_catalog_identifier';
    const SIMPLESELECT = 'pim_catalog_simpleselect';
    const BOOLEAN = 'pim_catalog_boolean';
    const NUMBER = 'pim_catalog_number';
    const PRICE_COLLECTION = 'pim_catalog_price_collection';
    const MULTISELECT = 'pim_catalog_multiselect';

    const ALL = [
        self::IDENTIFIER,
        self::SIMPLESELECT,
        self::BOOLEAN,
        self::NUMBER,
        self::PRICE_COLLECTION,
        self::MULTISELECT
    ];
    
    private function __construct()
    {
        
    }
}
