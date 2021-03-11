<?php

namespace SilverCommerce\SalePrices;

use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;
use SilverCommerce\TaxAdmin\Traits\Taxable;
use SilverStripe\ORM\DataObject;

/**
 * @method CatalgoueProduct Parent
 */
class SalePrice extends DataObject
{
    use Taxable;

    private static $db = [
        'BasePrice' => 'Decimal(9.3)',
        'Starts' => 'Datetime',
        'Ends' => 'Datetime'
    ];

    private static $has_one = [
        'Parent' => CatalogueProduct::class
    ];

    public function getBasePrice()
    {
        return $this->BasePrice;
    }

    public function getTaxRate()
    {
        return $this->Parent()->getTaxRate();
    }

    public function getShowPriceWithTax()
    {
        return $this->Parent()->getShowPriceWithTax();
    }

    public function getShowTaxString()
    {
        return $this->Parent()->getShowTaxString();
    }
}