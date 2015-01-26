<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Constraint;

use Magento\Catalog\Test\Page\Product\CatalogProductView;
use Magento\Mtf\Client\BrowserInterface;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\FixtureInterface;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Class AssertUpSellsProductsSection
 * Assert that product is displayed in up-sell section
 */
class AssertUpSellsProductsSection extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'middle';
    /* end tags */

    /**
     * Assert that product is displayed in up-sell section
     *
     * @param BrowserInterface $browser
     * @param FixtureInterface $product
     * @param InjectableFixture[] $relatedProducts,
     * @param CatalogProductView $catalogProductView
     * @return void
     */
    public function processAssert(
        BrowserInterface $browser,
        FixtureInterface $product,
        array $relatedProducts,
        CatalogProductView $catalogProductView
    ) {
        $browser->open($_ENV['app_frontend_url'] . $product->getUrlKey() . '.html');
        foreach ($relatedProducts as $relatedProduct) {
            \PHPUnit_Framework_Assert::assertTrue(
                $catalogProductView->getUpsellBlock()->isUpsellProductVisible($relatedProduct->getName()),
                'Product \'' . $relatedProduct->getName() . '\' is absent in up-sells products.'
            );
        }
    }

    /**
     * Text success product is displayed in up-sell section
     *
     * @return string
     */
    public function toString()
    {
        return 'Product is displayed in up-sell section.';
    }
}
