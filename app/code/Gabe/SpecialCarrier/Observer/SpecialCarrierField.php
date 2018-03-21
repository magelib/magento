<?php

namespace Gabe\SpecialCarrier\Observer;

use Magento\Framework\Event\ObserverInterface;

class SpecialCarrierField implements ObserverInterface
{

    /**
     * List of attributes that should be added to an order.
     *
     * @var array
     */
    private $attributes = [
        'selected_carrier_data'
    ];


    /**

     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        foreach ($this->attributes as $attribute) {
            if ($quote->hasData($attribute)) {
                $order->setData($attribute, $quote->getData($attribute));
            }
        }
        $shippingDescription = $order->getShippingDescription();
        $data = $quote->getData('selected_carrier_data');

            if ($data) {
                $data = unserialize($data);
                $shippingDescription .= 'Shipping Carrier Account Number:' . html_entity_decode('<br />');
                    $data['carrier_account'] . '; ';
                $shippingDescription .= __('Shipping Method:') .
                    $data['carrier_method'] . '; ';
                if ($data['carrier_instructions']) {
                    $shippingDescription .= __('Special Instructions:') .
                        $data['carrier_instructions'];
                }
                $order->setShippingDescription($shippingDescription);
            }


        return $this;
    }
}