<?php

namespace Dev\ExpertReview\Model\ResourceModel\ExpertReview;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'expert_review_id';

    protected function _construct()
    {
        $this->_init('Dev\ExpertReview\Model\ExpertReview', 'Dev\ExpertReview\Model\ResourceModel\ExpertReview');
    }
}
