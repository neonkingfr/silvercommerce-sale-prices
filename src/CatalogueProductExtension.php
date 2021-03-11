<?php

namespace SilverCommerce\SalePrices;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class CatalogueProductExtension extends DataExtension
{
    private static $has_many = [
        'SalePrices' => SalePrice::class
    ];
    
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
            'Root.Sales',
            $this->getOwner()->dbObject('SalePrices')->scaffoldFormField()
        );
    }
}
