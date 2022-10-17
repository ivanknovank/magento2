<?php

namespace Dev\ProductContent\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class AddNew extends Action
{
    public function execute()
    {
        $title = 'Product Content';
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
