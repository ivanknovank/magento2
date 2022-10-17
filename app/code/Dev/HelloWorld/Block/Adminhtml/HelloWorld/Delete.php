<?php

namespace Dev\HelloWorld\Controller\Adminhtml\HelloWorld;

use Dev\HelloWorld\Model\HelloWorldFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    protected $helloworldFactory;

    public function __construct(
        Context           $context,
        HelloWorldFactory $helloworldFactory
    ) {
        $this->helloworldFactory = $helloworldFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id', null);
        try {
            $helloWorldData = $this->helloworldFactory->create()->load($id);
            if ($helloWorldData->getId()) {
                $helloWorldData->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
            } else {
                $this->messageManager->addErrorMessage(__('Record does not exist.'));
            }
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        return $resultRedirect->setPath('*/*');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dev_HelloWorld::helloworld');
    }
}
