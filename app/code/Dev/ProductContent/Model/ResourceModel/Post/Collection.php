<?php

namespace Dev\ProductContent\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'product_content_id';

    protected function _construct()
    {
        $this->_init('Dev\ProductContent\Model\Post', 'Dev\ProductContent\Model\ResourceModel\Post');
    }
}
