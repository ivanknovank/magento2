<?php

namespace Dev\Banner1\Model\Config;


use Magento\Framework\Option\ArrayInterface;

class Color implements ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => __('5'), 'label' => __('Black')],
            ['value' => __('4'), 'label' => __('White')],
            ['value' => __('3'), 'label' => __('Green')],
            ['value' => __('1'), 'label' => __('Blue')],
            ['value' => __('0'), 'label' => __('Red')]
        ];
    }
}
