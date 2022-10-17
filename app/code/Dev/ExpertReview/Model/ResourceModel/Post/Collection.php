<?php

namespace Dev\ExpertReview\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'expert_id';

    protected function _construct()
    {
        $this->_init('Dev\ExpertReview\Model\Post', 'Dev\ExpertReview\Model\ResourceModel\Post');
    }
}
