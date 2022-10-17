<?php

namespace Dev\ExpertReview\Model\Config;

use Dev\ExpertReview\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    protected $_storeManager;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        StoreManagerInterface $_storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
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
            if (isset($data['image'])) {
                $imageData = json_decode($data['image'], true);
                $data['image'] = [
                    [
                        'name' => $imageData[0]['name'],
                        'url' => $url . $imageData[0]['url'],
                        'previewType' => $imageData[0]['previewType'],
                        'id' => $imageData[0]['id'],
                        'size' => $imageData[0]['size']
                    ]
                ];
            }
            $this->_loadedData[$item->getId()] = $data;
        }
        return $this->_loadedData;
    }
}
