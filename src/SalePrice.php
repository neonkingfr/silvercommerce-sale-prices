<?php

namespace SilverCommerce\SalePrices;

use SilverStripe\i18n\i18n;
use SilverStripe\ORM\DataObject;
use SilverCommerce\TaxAdmin\Traits\Taxable;
use SilverCommerce\TaxAdmin\Interfaces\TaxableProvider;
use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;

/**
 * @method CatalgoueProduct Parent
 */
class SalePrice extends DataObject implements TaxableProvider
{
    use Taxable;

    private static $table_name = "SalePrice";

    private static $db = [
        'BasePrice' => 'Decimal(9.3)',
        'Starts' => 'Datetime',
        'Ends' => 'Datetime'
    ];

    private static $has_one = [
        'Parent' => CatalogueProduct::class
    ];

    private static $summary_fields = [
        'BasePrice',
        'Starts',
        'Ends'
    ];

    public function getBasePrice()
    {
        return $this->dbObject('BasePrice')->getValue();
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

    public function getLocale()
    {
        return i18n::get_locale();
    }
}
