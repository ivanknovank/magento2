<?php

namespace Dev\CheckoutFields\Plugin\Checkout\Model;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Quote\Model\QuoteRepository;

class ShippingInformationManagement
{
    protected $quoteRepository;

    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface                          $addressInformation
    ) {
        if (!$extAttributes = $addressInformation->getExtensionAttributes()) {
            return;
        }
        $quote = $this->quoteRepository->getActive($cartId);
        // check donate value and set data to quote table
        if ($extAttributes->getDonatefield() > 0) {
            $quote->setDonatefield($extAttributes->getDonatefield());
        } else {
            $quote->setDonatefield(0);
        }
    }
}
