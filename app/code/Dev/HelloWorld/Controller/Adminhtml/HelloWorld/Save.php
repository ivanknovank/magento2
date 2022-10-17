<?php

namespace Dev\HelloWorld\Controller\Adminhtml\HelloWorld;

use Dev\HelloWorld\Model\HelloWorldFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;

class Save extends Action
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
        $storeId = (int)$this->getRequest()->getParam('store_id');
        $data = $this->getRequest()->getParams();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $params = [];
            $helloworldData = $this->helloworldFactory->create();
            $helloworldData->setStoreId($storeId);
            $params['store'] = $storeId;
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            } else {
                $helloworldData->load($data['entity_id']);
                $params['entity_id'] = $data['entity_id'];
            }
            $helloworldData->addData($data);
            $this->_eventManager->dispatch(
                'Dev_helloworld_helloworld_prepare_save',
                ['object' => $this->helloworldFactory, 'request' => $this->getRequest()]
            );
            try {
                $helloworldData->save();
                $this->messageManager->addSuccessMessage(__('You saved this record.'));
                $this->_getSession()->setForDevata(false);
                if ($this->getRequest()->getParam('back')) {
                    $params['entity_id'] = $helloworldData->getId();
                    $params['_current'] = true;
                    return $resultRedirect->setPath('*/*/edit', $params);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the record.'));
            }
            $this->_getSession()->setForDevata($this->getRequest()->getPostValue());
            return $resultRedirect->setPath('*/*/edit', $params);
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dev_HelloWorld::helloworld');
    }
}
