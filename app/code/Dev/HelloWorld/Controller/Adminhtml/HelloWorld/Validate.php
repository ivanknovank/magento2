<?php

namespace Dev\HelloWorld\Controler\Adminhtml\HelloWorld;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\DataObject;

class Validate extends Action
{
    protected $jsonFactory;
    protected $response;

    public function __construct(
        Context     $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->response = new DataObject();
    }

    public function execute()
    {
        $this->response->setError(0);
        $this->validateRequireEntries($this->getRequest()->getParams());
        $resultJson = $this->jsonFactory->create()->setData($this->response);
        return $resultJson;
    }

    public function validateRequireEntries(array $data)
    {
        $requiredFields = [
            'identifier' => __('Hello World Identifier'),
        ];
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $this->_addErrorMessage(
                    __('To apply changes you should fill in required "%1" field', $requiredFields[$field])
                );
            }
        }
    }

    protected function _addErrorMessage($message)
    {
        $this->response->setError(true);
        if (!is_array($this->response->getMessages())) {
            $this->response->setMessages([]);
        }
        $messages = $this->response->getMessages();
        $messages[] = $message;
        $this->response->setMessages($messages);
    }
}
