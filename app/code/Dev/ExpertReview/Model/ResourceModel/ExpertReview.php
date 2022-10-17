<?php

namespace Dev\ExpertReview\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ExpertReview extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('expert_review', 'expert_review_id');
    }
}
