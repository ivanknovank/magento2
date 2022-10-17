<?php

namespace Dev\CheckoutFields\Model\Total;

use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\QuoteValidator;

class Donate extends AbstractTotal
{
    protected $quoteValidator = null;

    public function __construct(QuoteValidator $quoteValidator)
    {
        $this->quoteValidator = $quoteValidator;
    }

    public function collect(
        Quote                       $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total                       $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        $exist_amount = 0;
        $donate = $quote['donatefield'];
        $balance = $donate - $exist_amount;
        $total->setTotalAmount('donate', $balance);
        $total->setBaseTotalAmount('donate', $balance);
        $total->setdonate($balance);
        $total->setBasedonate($balance);
        $total->setGrandTotal($total->getGrandTotal());
        $total->setBaseGrandTotal($total->getBaseGrandTotal());
        return $this;
    }

    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => 'donate',
            'title' => 'Donate',
            'value' => $quote['donatefield'],
        ];
    }

    public function getLabel()
    {
        return __('Donate');
    }

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
}
