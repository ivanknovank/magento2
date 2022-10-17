<?php

namespace Dev\CheckoutFields\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template;
use Magento\Framework\App\ObjectManager;

class DonateView extends Template
{
    public function myFunction()
    {
        //get sales_order by id
        $orderId = $this->_request->getParam('order_id');
        $objectManager = ObjectManager::getInstance();
        return $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($orderId);
    }
}
