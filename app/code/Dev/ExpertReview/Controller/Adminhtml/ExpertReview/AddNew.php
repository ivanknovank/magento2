<?php

namespace Dev\ExpertReview\Controller\Adminhtml\ExpertReview;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class AddNew extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $title = 'Edit Expert Review';
        } else {
            $title = 'Add Expert Review';
        }
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }
}
