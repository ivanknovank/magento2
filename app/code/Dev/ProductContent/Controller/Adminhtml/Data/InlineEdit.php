<?php

namespace Dev\ProductContent\Controller\Adminhtml\Data;

use Dev\ProductContent\Model\PostFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    protected $jsonFactory;
    private $postFactory;

    public function __construct(
        Context     $context,
        JsonFactory $jsonFactory,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    $model = $this->postFactory->create()->load($modelid);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                        $model->save();
                    } catch (Exception $e) {
                        $messages[] = "[Customform ID: {$modelid}] {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error]);
    }
}
