<?php

namespace Dev\HelloWorld\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;

class HelloWorldSetup extends EavSetup
{
    const ENTITY_TYPE_CODE = 'Dev_helloworld_helloworld';

    public function getDefaultEntities()
    {
        $entities = [
            self::ENTITY_TYPE_CODE => [
                'entity_model' => 'Dev\HelloWorld\Model\ResourceModel\HelloWorld',
                'attribute_model' => 'Dev\HelloWorld\Model\ResourceModel\Eav\Attribute',
                'table' => self::ENTITY_TYPE_CODE,
                'increment_model' => null,
                'additional_attribute_table' => 'Dev_helloworld_eav_attribute',
                'entity_attribute_collection' => 'Dev\HelloWorld\Model\ResourceModel\Attribute\Collection',
                'attributes' => $this->getAttributes(),
            ],
        ];
        return $entities;
    }

    protected function getAttributes()
    {
        $attributes = [];
        $attributes['main_title'] = [
            'group' => 'General',
            'type' => 'varchar',
            'label' => 'Main Title',
            'input' => 'text',
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'required' => '1',
            'user_defined' => false,
            'default' => '',
            'unique' => false,
            'position' => '10',
            'note' => '',
            'visible' => '1',
            'wysiwyg_enabled' => '0',
        ];
        // Add your more entity attributes here...
        return $attributes;
    }
}
