<?php

namespace Dev\ProductContent\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_content', 'product_content_id');
    }
}
