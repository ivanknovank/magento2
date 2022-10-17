<?php

namespace Dev\Banner1\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'banner_id';

    protected function _construct()
    {
        $this->_init('Dev\Banner1\Model\Post', 'Dev\Banner1\Model\ResourceModel\Post');
    }
}
