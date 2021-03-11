<?php

namespace SilverCommerce\SalePrices\Tests;

use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;
use SilverCommerce\SalePrices\SalePriceHelper;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBDatetime;

class SalePriceHelperTest extends SapphireTest
{
    protected static $fixture_file = 'OrdersScaffold.yml';

    public function testGetReleventSalePrice()
    {
        $product = $this->objFromFixture(CatalogueProduct::class, 'product_one');
        $helper = SalePriceHelper::create($product);

        DBDatetime::set_mock_now('2021-01-01 00:00:00');

        $price = $helper->getReleventSalePrice();

        $this->assertNull($price);
    }
}