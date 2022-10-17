<?php
namespace Dev\CustomCmsPage\Plugin\Cms\Model\Page;

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

    public function afterGetData(\Magento\Cms\Model\Page\DataProvider $subject, $check)
    {
        //get page_id
        $id = $this->getPageId($subject);
        //set page[check] = true if page is exist
        $check[$id]['check'] = true;
        return $check;
    }
}
