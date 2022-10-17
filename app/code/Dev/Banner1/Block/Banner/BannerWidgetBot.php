<?php

namespace Dev\Banner1\Block\Banner;

use Dev\Banner1\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class BannerWidgetBot extends Template implements BlockInterface
{
    protected $postCollectionFactory;

    public function __construct(
        Template\Context  $context,
        array             $data,
        CollectionFactory $postCollectionFactory
    ) {
        $this->setTemplate('widgetbot.phtml');
        $this->postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    public function bottomBanner()
    {
        $collection = $this->postCollectionFactory->create();

        //get position and enable image
        $banner1 = $collection->addFieldToFilter('display_position', [['eq' => '1'], ['eq' => '0']])
            ->addFieldToFilter('status', ['eq' => true])
            ->getData();

        //get url
        $url = $this->setData('mediaURL', $this->_storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA));
        return [
            "data" => $banner1,
            "url" => $url
        ];
    }
}
