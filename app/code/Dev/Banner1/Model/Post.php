<?php

namespace Dev\Banner1\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\Banner1\Model\ResourceModel\Post');
    }
}
