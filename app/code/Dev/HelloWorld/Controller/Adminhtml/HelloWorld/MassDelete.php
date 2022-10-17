<?php

namespace Dev\HelloWorld\Controller\Adminhtml\HelloWorld;

use Dev\HelloWorld\Model\ResourceModel\HelloWorld\Collection;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected $filter;
    protected $helloworldCollection;

    public function __construct(Context $context, Filter $filter, Collection $helloworldCollection)
    {
        $this->filter = $filter;
        $this->helloworldCollection = $helloworldCollection;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->helloworldCollection);
        $collectionSize = $collection->getSize();
        $collection->walk('delete');
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
