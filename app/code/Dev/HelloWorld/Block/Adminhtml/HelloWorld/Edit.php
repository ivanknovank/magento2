<?php

namespace Dev\HelloWorld\Controller\Adminhtml\HelloWorld;

use Dev\HelloWorld\Model\HelloWorldFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $_coreRegistry = null;
    protected $resultPageFactory;
    protected $helloworldFactory;

    public function __construct(
        Context           $context,
        PageFactory       $resultPageFactory,
        Registry          $registry,
        HelloWorldFactory $helloworldFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->helloworldFactory = $helloworldFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $helloworldData = $this->helloworldFactory->create();
        if ($id) {
            $helloworldData->load($id);
            if (!$helloworldData->getId()) {
                $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $helloworldData->addData($data);
        }
        $this->_coreRegistry->register('entity_id', $id);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dev_HelloWorld::helloworld');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Record'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dev_HelloWorld::helloworld');
    }
}
