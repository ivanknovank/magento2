<?php

namespace Dev\CheckoutFields\Block\Sales\Order;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Tax\Model\Config;

class Donate extends Template
{
    protected $_config;

    protected $_order;

    protected $_source;

    public function __construct(
        Context $context,
        Config  $taxConfig,
        array   $data = []
    ) {
        $this->_config = $taxConfig;
        parent::__construct($context, $data);
    }

    public function displayFullSummary()
    {
        return true;
    }

    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $store = $this->getStore();
        if ($this->_source->getDonatefield()>0) {
            $donate = new DataObject(
                [
                    'code' => 'donate',
                    'strong' => false,
                    'value' => $this->_source->getDonatefield(),
                    'label' => __('Donate'),
                ]
            );
            $parent->addTotal($donate, 'donate');
        }
        return $this;
    }

    public function getOrder()
    {
        return $this->_order;
    }

    public function getSource()
    {
        return $this->_source;
    }

    public function getStore()
    {
        return $this->_order->getStore();
    }
}
