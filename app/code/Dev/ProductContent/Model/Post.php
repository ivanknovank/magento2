<?php

namespace Dev\ProductContent\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\ProductContent\Model\ResourceModel\Post');
    }
}
