<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gabe\SpecialCarrier\Controller\Index;

class Index extends \Magento\Checkout\Controller\Onepage
{
    /**
     * Checkout page
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $params = $this->getRequest()->getParam('specialCarrierInformation');

        $data = serialize($params);
        $quote = $this->getOnepage()->getQuote();
        $quote->setData('selected_carrier_data',$data);
        $quote->save();
    }
}
