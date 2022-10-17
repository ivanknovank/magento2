<?php

namespace Dev\Catalog\Block\Product\ProductList;

use Magento\Framework\View\Element\Template;

class Upsell extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getTitle()
    {
        $title = 'CLICK HERE';
        return __($title);
    }

    public function getPostData()
    {
        return __('getpostdata');
    }

    public function getViewModel()
    {
        return __('getViewModel');
    }

    public function getAddToCartUrl()
    {
        return __('getAddToCartUrl');
    }

    public function getEntityId()
    {
        return __('getEntityId');
    }

}
