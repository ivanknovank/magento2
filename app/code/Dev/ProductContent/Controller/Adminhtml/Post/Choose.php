<?php

namespace Dev\ProductContent\Controller\Adminhtml\Post;

use Dev\ProductContent\Model\PostFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Choose extends Action
{
    private $postFactory;

    protected $_productCollection;

    protected $_collection;

    public function __construct(
        Action\Context       $context,
        PostFactory          $postFactory,
        CollectionFactory    $productCollection,
        \Dev\ProductContent\Model\ResourceModel\Post\CollectionFactory $collection
    ) {
        parent::__construct($context);
        $this->_productCollection = $productCollection;
        $this->postFactory = $postFactory;
        $this->_collection = $collection;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $product = $this->_productCollection->create()->addFieldToFilter('entity_id', $id)->getData();
        $data = $this->getRequest()->getPostValue();

        $newData = [
            'entity_id' => $product[0]['entity_id'],
        ];

        $post = $this->postFactory->create();

        if ($id) {
            $post->load($id);
        }
        try {
            $post->addData($newData);
            $post->save();
            $item = $this->_collection->create()->getData();
            $product_content_size = sizeof($item) -1;
            $product_content_id = $item[$product_content_size]['product_content_id'];
            $save =  $item[$product_content_size - 1]['product_content_id'];
            $this->getMessageManager()->addSuccessMessage(__('You chosen the product.'));
            return $this->resultRedirectFactory->create()->setPath('productcontent/post/addnew', ['id' => $product_content_id]);
        } catch (Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Error'));
        }
    }
}
