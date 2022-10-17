<?php
namespace Dev\ProductContent\Block\Product\View;

use Dev\ProductContent\Model\ResourceModel\Post\CollectionFactory;
use Magento\Widget\Block\BlockInterface;

class ProductDetails extends \Magento\Framework\View\Element\Template implements BlockInterface
{
    protected $_product = null;

    protected $_coreRegistry = null;

    protected $postCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry                      $registry,
        CollectionFactory                                $postCollectionFactory,
        \Zend_Filter_Interface $templateProcessor,
        array                                            $data = []
    ) {
        $this->setTemplate('product_detail.phtml');
        $this->postCollectionFactory = $postCollectionFactory;
        $this->_coreRegistry = $registry;
        $this->templateProcessor = $templateProcessor;
        parent::__construct($context, $data);
    }

    public function filterOutputHtml($string)
    {
        return $this->templateProcessor->filter($string);
    }

    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    public function getProductContent(): ?array
    {
        $id = $this->getRequest()->getParam('id');
        $collection = $this->postCollectionFactory->create();
        //get content
        return $collection->addFieldToFilter('status', ['eq' => '1'])
            ->addFieldToFilter('entity_id', $id)
            ->getData();
    }
}
