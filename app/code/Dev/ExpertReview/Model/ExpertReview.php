<?php

namespace Dev\ExpertReview\Model;

use Magento\Framework\Model\AbstractModel;

class ExpertReview extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\ExpertReview\Model\ResourceModel\ExpertReview');
    }
}
