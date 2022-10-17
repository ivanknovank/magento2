<?php

namespace Dev\FSShipping\Controller\Post;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Checkout\Block\Cart\Item\Renderer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;

class Index extends Action
{
    protected $_productCollection;

    public $_renderer;

    public function __construct(
        Context           $context,
        CollectionFactory $productCollection,
        Renderer          $renderer,
        array             $data = []
    ) {
        $this->_productCollection = $productCollection;
        $this->_renderer = $renderer;
        return parent::__construct($context);
    }

    public function execute()
    {
        $objectManager = ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        $items = $cart->getQuote()->getItems();

        $checkFreeShipping = false;
        foreach ($items as $item) {
            $id = $item->getProductId();
            $product = $this->_productCollection->create()->addFieldToFilter('entity_id', $id)->addAttributeToSelect('fs_shipping', 'catalog_product_entity_int')->getData();
            if (!empty($product)) {
                if ($product[0]['fs_shipping'] == 1) {
                    $checkFreeShipping = true;
                }
            }
        }
        var_dump($checkFreeShipping);
        die();
    }
}
