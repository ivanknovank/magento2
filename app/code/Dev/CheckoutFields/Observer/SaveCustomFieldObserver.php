<?php declare(strict_types=1);


namespace Dev\CheckoutFields\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveCustomFieldObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        // Get Order Object
        $order = $event->getOrder();
        // Get Quote Object
        $quote = $event->getQuote();
        // set data from quote table to sales_order table
        if ($quote->getDonatefield()) {
            $order->setDonatefield($quote->getDonatefield());
        }
        return $this;
    }
}
