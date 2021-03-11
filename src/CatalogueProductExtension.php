<?php

namespace SilverCommerce\SalePrices;

use SilverStripe\ORM\DataExtension;

class CatalogueProductExtension extends DataExtension
{
    private static $has_many = [
        'SalePrices' => SalePrice::class
    ];

    public function getNiceSalePrice()
    {
        /** @var \SilverCommerce\CatalogueAdmin\Model\CatalogueProduct */
        $owner = $this->getOwner();
        $helper = SalePriceHelper::create($owner);
        $sale = $helper->getReleventSalePrice();

        if (empty($sale)) {
            return $owner->getNicePrice();
        }

        return $sale->getNicePrice();
    }
}
