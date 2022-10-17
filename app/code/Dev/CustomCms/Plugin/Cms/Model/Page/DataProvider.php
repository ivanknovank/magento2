<?php
namespace Dev\CustomCms\Plugin\Cms\Model\Page;

use Magento\Framework\App\RequestInterface;

class DataProvider
{
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    private function getPageId(\Magento\Cms\Model\Page\DataProvider $subject): int
    {
        return (int) $this->request->getParam($subject->getRequestFieldName());
    }

    public function afterGetMeta(\Magento\Cms\Model\Page\DataProvider $subject)
    {
        $id = $this->getPageId($subject);
        $check = false;
        if (!empty($id)) {
            $check = true;
        }
        $customLayoutMeta = [
            'search_engine_optimisation' => [
                'children' => [
                    'identifier' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'disabled' => $check
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return array_merge_recursive($customLayoutMeta);
    }
}
