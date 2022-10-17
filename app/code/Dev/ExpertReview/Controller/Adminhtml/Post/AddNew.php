<?php

namespace Dev\ExpertReview\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class AddNew extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $title = 'Edit Expert';
        } else {
            $title = 'Add Expert';
        }
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
