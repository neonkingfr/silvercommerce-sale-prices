# Sale Prices

Set multiple possible sale prices on products that can be scheduled
with an start and end date.

The new price can then be rendered using provided template and
automatically updates shopping cart prices.

## Installation

Install via composer:

    composer require silvercommerce/sale-prices

## Setup

Login to the admin and navigate to a product. There will now be a
"Sale Prices" tab.

Queue up any relevent sale prices.

Next, replace the `$NicePrice` variable in your `Product.ss` and `ProductSummary.ss` templates (and any other relevent templates). 
