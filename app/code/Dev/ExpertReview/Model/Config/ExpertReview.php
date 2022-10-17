<?php

namespace Dev\ExpertReview\Model\Config;

use Dev\ExpertReview\Model\ResourceModel\ExpertReview\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class ExpertReview extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    protected $_storeManager;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $expertReviewCollectionFactory,
        StoreManagerInterface $_storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $expertReviewCollectionFactory->create();
        $this->_storeManager = $_storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        $url = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        foreach ($items as $item) {
            $data = $item->getData();
            $this->_loadedData[$item->getId()] = $data;
        }
        return $this->_loadedData;
    }
}
