<?php

namespace SilverCommerce\SalePrices;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;

class SalePriceHelper
{
    use Configurable, Injectable;

    /**
     * Base product to check against
     *
     * @var CatalogueProduct
     */
    protected $product;

    /**
     * Instantiate this object and set relvent product
     */
    public function __construct(CatalogueProduct $product)
    {
        $this->setProduct($product);
    }

    /**
     * Find the most relevent sale price for the chosen product
     *
     * @return SalePrice
     */
    public function getReleventSalePrice()
    {
        $now = new \DateTime(
            DBDatetime::now()->format(DBDatetime::ISO_DATETIME)
        );
        $now_formatted = $now->format('Y-m-d H:i:s');

        return SalePrice::get()
            ->filter(
                [
                    'Starts:GreaterThanOrEqual' => $now_formatted,
                    'Ends:LessThanOrEqual' => $now_formatted
                ]
            )->sort('Starts', 'DESC')
            ->first();
    }

    /**
     * Find the most relevent sale price for the chosen product
     *
     * @return SalePrice
     */
    public function getCurrentPrice()
    {
        $price = $this->getReleventSalePrice();
        $product = $this->getProduct();

        if (empty($price)) {
            return $product->getBasePrice();
        }

        return $price->getBasePrice();
    }

    /**
     * Get base product to check against
     *
     * @return CatalogueProduct
     */ 
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set base product to check against
     *
     * @param  CatalogueProduct $product
     *
     * @return  self
     */ 
    public function setProduct(CatalogueProduct $product)
    {
        $this->product = $product;
        return $this;
    }
}
