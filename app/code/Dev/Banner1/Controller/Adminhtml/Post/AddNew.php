<?php

namespace Dev\Banner1\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class AddNew extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $title = 'Edit Banner';
        } else {
            $title = 'Add Banner';
        }
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
