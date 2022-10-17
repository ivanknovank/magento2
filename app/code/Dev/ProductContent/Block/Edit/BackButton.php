<?php

namespace Dev\ProductContent\Block\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    protected $_collection;

    public function __construct(
        Context $context,
        \Dev\ProductContent\Model\ResourceModel\Post\CollectionFactory $collection
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->_collection = $collection;
    }

    public function getButtonData()
    {
        return
            [
                'label' => __('Back'),
                'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
                'class' => 'back',
                'sort_order' => 10
            ];
    }

    public function getBackUrl()
    {
        return $this->urlBuilder->getUrl('*/*/');
    }
}
