<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gabe\SpecialCarrier\Block\Checkout;

use Magento\Framework\App\ObjectManager;

/**
 * Class LayoutProcessor
 */
class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    /**
     * Process js Layout of block
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
                ['shippingAddress']['component'] = 'Gabe_SpecialCarrier/js/view/shipping';
        }
        return $jsLayout;
    }
}
