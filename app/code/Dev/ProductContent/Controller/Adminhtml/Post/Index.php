<?php

namespace Dev\ProductContent\Controller\Adminhtml\Post;

use Dev\ProductContent\Model\ResourceModel\Post\CollectionFactory;
use Magento\Backend\App\Action;
use Dev\ProductContent\Model\PostFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $postFactory;

    protected $_pageFactory;

    protected $_collection;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        PostFactory          $postFactory,
        CollectionFactory $collection
    ) {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_collection = $collection;
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $items = $this->_collection->create()->getData();
        foreach ($items as $item) {
            if (is_null($item['product_name'])) {
                $deletePost = $this->postFactory->create()->load($item['product_content_id']);
                $deletePost->delete();
            }
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Product Content Listing'));
        return $resultPage;
    }
}
