<?php

namespace Dev\Banner1\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getTitle()
    {
        return __('Banner');
    }
}
