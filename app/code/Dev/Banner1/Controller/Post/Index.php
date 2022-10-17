<?php

namespace Dev\Banner1\Controller\Post;

use Dev\Banner1\Model\PostFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $postFactory;

    public function __construct(
        Context $context,
        PostFactory        $postFactory
    ) {
        $this->postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->postFactory->create()->getCollection();
        foreach ($data as $value) {
            echo "<pre>";
            print_r($value->getData());
            echo "</pre>";
        }
    }
}
