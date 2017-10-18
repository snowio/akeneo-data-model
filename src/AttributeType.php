<?php
namespace SnowIO\AkeneoDataModel;

abstract class AttributeType
{
    const PIM_CATALOG_IDENTIFIER = 'pim_catalog_identifier';
    const PIM_CATALOG_SIMPLESELECT = 'pim_catalog_simpleselect';
    const PIM_CATALOG_BOOLEAN = 'pim_catalog_boolean';
    const PIM_CATALOG_NUMBER = 'pim_catalog_number';
    const PIM_CATALOG_PRICE_COLLECTION = 'pim_catalog_price_collection';
    const PIM_CATALOG_MULTISELECT = 'pim_catalog_multiselect';

    const ALL = [
        self::PIM_CATALOG_IDENTIFIER,
        self::PIM_CATALOG_SIMPLESELECT,
        self::PIM_CATALOG_BOOLEAN,
        self::PIM_CATALOG_NUMBER,
        self::PIM_CATALOG_PRICE_COLLECTION,
        self::PIM_CATALOG_MULTISELECT
    ];
}
