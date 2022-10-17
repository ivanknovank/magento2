<?php

namespace Dev\CheckoutFields\Controller\Index;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\Action\Context;

class RemoveDonate extends \Magento\Framework\App\Action\Action
{
    protected $_resultFactory;

    protected $quoteFactory;

    private $checkoutSession;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        CheckoutSession $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->quoteFactory = $quoteFactory;
        $this->_resultFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $remove_donate = $this->getRequest()->getParam('remove_donate');
        $quoteId = $this->checkoutSession->getQuote()->getId();
        if (isset($remove_donate)) {
            $quote = $this->quoteFactory->create()->load($quoteId)->setData('donatefield', 0)->save();
        }
    }
}
