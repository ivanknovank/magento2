<?php

namespace Dev\HelloWorld\Block\Adminhtml\HelloWorld\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    /* [__construct desription]
    * @param Context $context [description]
    */
    public function __construct(Context $context)
    {
        $this->urlBuilder = $context->getUrlBuilder();
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
