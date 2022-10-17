<?php

namespace Dev\ProductContent\Controller\Post;

use Dev\ProductContent\Model\PostFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{
    protected $postFactory;

    public function __construct(
        Context     $context,
        PostFactory $postFactory
    )
    {
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
