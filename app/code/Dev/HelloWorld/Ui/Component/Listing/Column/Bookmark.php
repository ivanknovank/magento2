<?php

namespace Dev\HelloWorld\Ui\Component\Listing\Column;

use Dev\HelloWorld\Model\HelloWorld;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Api\BookmarkManagementInterface;
use Magento\Ui\Api\BookmarkRepositoryInterface;

class Bookmark extends \Magento\Ui\Component\Bookmark
{
    /**
     * @var HelloWorld
     */
    protected $helloworld;

    public function __construct(
        ContextInterface                 $context,
        HelloWorld $helloworld,
        BookmarkRepositoryInterface      $bookmarkRepository,
        BookmarkManagementInterface      $bookmarkManagement,
        array                            $components = [],
        array                            $data = []
    ) {
        parent::__construct($context, $bookmarkRepository, $bookmarkManagement, $components, $data);
        $this->helloworld = $helloworld;
    }

    public function prepare()
    {
        $namespace = $this->getContext()->getRequestParam('namespace', $this->getContext()->getNamespace());
        $config = [];
        if (!empty($namespace)) {
            $storeId = $this->getContext()->getRequestParam('store');
            if (empty($storeId)) {
                $storeId = $this->getContext()->getFilterParam('store_id');
            }
            $bookmarks = $this->bookmarkManagement->loadByNamespace($namespace);
            foreach ($bookmarks->getItems() as $bookmark) {
                if ($bookmark->isCurrent()) {
                    $config['activeIndex'] = $bookmark->getIdentifier();
                }
                $config = array_merge_recursive($config, $bookmark->getConfig());
                if (!empty($storeId)) {
                    $config['current']['filters']['applied']['store_id'] = $storeId;
                }
            }
        }
        $this->setData('config', array_replace_recursive($config, $this->getConfiguration($this)));
        parent::prepare();
        $jsConfig = $this->getConfiguration($this);
        $this->getContext()->addComponentDefinition($this->getComponentName(), $jsConfig);
    }
}
