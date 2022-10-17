<?php

namespace Dev\HelloWorld\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $helloworldSetupFactory;

    public function __construct(HelloWorldSetupFactory $helloworldSetupFactory)
    {
        $this->helloworldSetupFactory = $helloworldSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $helloworldSetup = $this->helloworldSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $helloworldSetup->installEntities();
        $entities = $helloworldSetup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $helloworldSetup->addEntityType($entityName, $entity);
        }
        $setup->endSetup();
    }
}
