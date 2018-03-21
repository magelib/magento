<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gabe\SpecialCarrier\Model\Carrier;

use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Address\RateRequest;

/**
 * Table rate shipping model
 *
 * @api
 * @since 100.0.2
 */
class SpecialCarrier extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'int_specialcarrier';

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_resultMethodFactory;
    protected $_appState;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $resultMethodFactory
     * @param array $data
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $resultMethodFactory,
        \Magento\Framework\App\State $appState,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_resultMethodFactory = $resultMethodFactory;
        $this->_appState = $appState;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * @param RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function collectRates(RateRequest $request)
    {
        $areaCode = $this->_appState->getAreaCode();
        if ($areaCode === \Magento\Framework\App\Area::AREA_ADMIN ||
            $areaCode === \Magento\Framework\App\Area::AREA_ADMINHTML) {
            return false;
        }

        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        $method = $this->_resultMethodFactory->create();

        $method->setCarrier('int_specialcarrier');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('method1');
        $method->setMethodTitle($this->getConfigData('method1name'));

        $price = $this->getConfigData('method1price');
        $method->setPrice($price);
        $method->setCost($price);
        $result->append($method);

//        $method = $this->_resultMethodFactory->create();
//        $method->setCarrier('int_specialcarrier');
//        $method->setCarrierTitle($this->getConfigData('title'));
//        $method->setMethod('method2');
//        $method->setMethodTitle($this->getConfigData('method2name'));
//        $price = $this->getConfigData('method2price');
//        $method->setPrice($price);
//        $method->setCost($price);
//        $result->append($method);

        return $result;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [
            'specialcarrier' => $this->getConfigData('specialcarriername')
        ];
    }
}
