<?php

namespace SilverCommerce\SalePrices\Tests;

use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;
use SilverCommerce\SalePrices\SalePriceHelper;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBDatetime;

class SalePriceHelperTest extends SapphireTest
{
    protected static $fixture_file = 'SalePriceFixtures.yml';

    public function testGetReleventSalePrice()
    {
        $product = $this->objFromFixture(CatalogueProduct::class, 'product_one');
        $helper = SalePriceHelper::create($product);

        DBDatetime::set_mock_now('2021-01-01 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertNull($price);

        DBDatetime::set_mock_now('2021-04-01 07:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(5.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-04-02 10:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(5.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-04-04 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertNull($price);

        DBDatetime::set_mock_now('2021-06-01 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(4.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-06-04 13:45:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(4.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-06-08 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertNull($price);

        DBDatetime::set_mock_now('2021-09-01 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(3.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-09-15 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertEquals(3.99, $price->BasePrice);

        DBDatetime::set_mock_now('2021-09-26 00:00:00');
        $price = $helper->getReleventSalePrice();
        $this->assertNull($price);
    }

    public function testGetCurrentPrice()
    {
        $product = $this->objFromFixture(CatalogueProduct::class, 'product_one');
        $helper = SalePriceHelper::create($product);

        DBDatetime::set_mock_now('2021-01-01 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(10.99, $price);

        DBDatetime::set_mock_now('2021-04-01 07:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(5.99, $price);

        DBDatetime::set_mock_now('2021-04-02 10:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(5.99, $price);

        DBDatetime::set_mock_now('2021-04-04 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(10.99, $price);

        DBDatetime::set_mock_now('2021-06-01 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(4.99, $price);

        DBDatetime::set_mock_now('2021-06-04 13:45:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(4.99, $price);

        DBDatetime::set_mock_now('2021-06-08 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(10.99, $price);

        DBDatetime::set_mock_now('2021-09-01 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(3.99, $price);

        DBDatetime::set_mock_now('2021-09-15 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(3.99, $price);

        DBDatetime::set_mock_now('2021-09-26 00:00:00');
        $price = $helper->getCurrentPrice();
        $this->assertEquals(10.99, $price);
    }
}
