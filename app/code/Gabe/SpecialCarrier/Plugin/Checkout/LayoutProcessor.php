<?php
namespace Gabe\SpecialCarrier\Plugin\Checkout;
class LayoutProcessor
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    )
    {
        /*$jsLayout you can set your field that you want to customize*/
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['component'] = 'Gabe_SpecialCarrier/js/view/shipping';
        return $jsLayout;
    }
}