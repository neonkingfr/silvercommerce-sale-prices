<?php

namespace SilverCommerce\SalePrices;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataExtension;

class CatalogueProductExtension extends DataExtension
{
    private static $has_many = [
        'SalePrices' => SalePrice::class
    ];
}
