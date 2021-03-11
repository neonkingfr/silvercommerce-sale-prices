<?php

namespace SilverCommerce\SalePrices;

use SilverCommerce\CatalogueAdmin\Model\CatalogueProduct;
use SilverStripe\ORM\DataExtension;

class LineItemExtension extends DataExtension
{
    public function onBeforeWrite()
    {
        /** @var LineItem */
        $owner = $this->getOwner();
        /** @var CatalogueProduct */
        $product = $owner->FindStockItem();

        if (empty($product) || !is_a($product, CatalogueProduct::class)) {
            return;
        }

        $helper = SalePriceHelper::create($product);
        $owner->BasePrice = $helper->getCurrentPrice();
        return;
    }
}
