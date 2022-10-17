<?php

namespace Dev\FSShipping\Model\Carrier;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Psr\Log\LoggerInterface;

class FSShipping extends AbstractCarrier implements CarrierInterface
{
    protected $_code = 'fsshipping';

    protected $_isFixed = true;

    protected $_rateResultFactory;

    protected $_rateMethodFactory;

    protected $_productCollection;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory         $rateErrorFactory,
        LoggerInterface      $logger,
        ResultFactory        $rateResultFactory,
        CollectionFactory    $productCollection,
        MethodFactory        $rateMethodFactory,
        array                $data = []
    ) {
        $this->_productCollection = $productCollection;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        //get cart and product data
        $objectManager = ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        $subTotal = $cart->getQuote()->getSubtotal();
        $result = $this->_rateResultFactory->create();
        $this->_updateFreeMethodQuote($request);
        $items = $cart->getQuote()->getItems();
        $method = $this->_rateMethodFactory->create();
        $checkFreeShipping = false;

        $method->setCarrier('fsshipping');
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod('fsshipping');
        $method->setMethodTitle($this->getConfigData('name'));
        $price = $this->getConfigData('shipping_cost');
        $freeShipping = $this->getConfigData('setfreeshipping');

        //Check the cart for free shipping
        foreach ($items as $item) {
            $id = $item->getProductId();
            $product = $this->_productCollection->create()->addFieldToFilter('entity_id', $id)->addAttributeToSelect('fs_shipping', 'catalog_product_entity_int')
                ->getData();
            if (!empty($product)) {
                if ($product[0]['fs_shipping'] == 1) {
                    $checkFreeShipping = true;
                }
            }
        }

        if ($subTotal >= $freeShipping || $checkFreeShipping) {
            $price = 0;
        }

        $method->setPrice($price);
        $method->setCost($price);
        $result->append($method);

        return $result;
    }

    public function getAllowedMethods(): array
    {
        return [$this->_code => $this->getConfigData('name')];
    }
}
