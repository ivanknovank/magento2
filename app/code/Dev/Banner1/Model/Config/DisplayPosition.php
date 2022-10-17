<?php

namespace Dev\Banner1\Model\Config;


use Magento\Framework\Option\ArrayInterface;

class DisplayPosition implements ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => __('2'), 'label' => __('After Page Header')],
            ['value' => __('1'), 'label' => __('Before Page Footer')],
            ['value' => __('0'), 'label' => __('All')]
        ];
    }
}
