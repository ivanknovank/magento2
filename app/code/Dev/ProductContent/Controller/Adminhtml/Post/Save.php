<?php

namespace Dev\ProductContent\Controller\Adminhtml\Post;

use Dev\ProductContent\Model\PostFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Save extends Action
{
    private $postFactory;

    protected $_productCollection;

    public function __construct(
        Action\Context       $context,
        PostFactory          $postFactory,
        CollectionFactory    $productCollection
    ) {
        parent::__construct($context);
        $this->_productCollection = $productCollection;
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['product_content_id']) ? $data['product_content_id'] : null;
        $product = $this->_productCollection->create()->addFieldToFilter('entity_id', $data['entity_id'])->addAttributeToSelect('name', 'catalog_product_entity_varchar')->getData();

        $newData = [
            'content' => $data['content'],
            'entity_id' => $data['entity_id'],
            'status' => $data['status'],
            'display_position' => $data['display_position'],
            'product_sku' => $product[0]['sku'],
            'product_name' => $product[0]['name'],
        ];

        $post = $this->postFactory->create();

        if ($id) {
            $post->load($id);
        }
        try {
            $post->addData($newData);
            $post->save();
            $this->getMessageManager()->addSuccessMessage(__('You saved the post.'));
            return $this->resultRedirectFactory->create()->setPath('productcontent/post/index');
        } catch (Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Error'));
        }
    }
}
