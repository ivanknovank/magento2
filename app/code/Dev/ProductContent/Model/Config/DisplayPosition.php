<?php

namespace Dev\ProductContent\Model\Config;


use Magento\Framework\Option\ArrayInterface;

class DisplayPosition implements ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => __('2'), 'label' => __('Top Product Detail')],
            ['value' => __('1'), 'label' => __('Bottom Product Detail')],
        ];
    }
}
