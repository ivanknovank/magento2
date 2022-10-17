<?php

namespace Dev\Banner1\Model\Config;


use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => __('1'), 'label' => __('Enabled')],
            ['value' => __('0'), 'label' => __('Disabled')]
        ];
    }
}
