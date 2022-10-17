<?php

namespace Dev\ExpertReview\Controller\Adminhtml\ExpertReview;

use Dev\ExpertReview\Model\ExpertReviewFactory;
use Dev\ExpertReview\Model\ResourceModel\ExpertReview\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends Action
{
    private $expertReviewFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context    $context,
        ExpertReviewFactory       $expertReviewFactory,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory   $redirectFactory
    ) {
        parent::__construct($context);
        $this->expertReviewFactory = $expertReviewFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $total = 0;
        $err = 0;
        foreach ($collection->getItems() as $item) {
            $deleteExpertReview = $this->expertReviewFactory->create()->load($item->getData('expert_review_id'));
            try {
                $deleteExpertReview->delete();
                $total++;
            } catch (LocalizedException $exception) {
                $err++;
            }
        }

        if ($total) {
            $this->messageManager->addSuccessMessage(
                __('A total have been deleted.', $total)
            );
        }
        if ($err) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total  haven\'t been deleted. Please see server logs for more details.',
                    $err
                )
            );
        }
        return $this->resultRedirect->create()->setPath('expertreview/expertreview/index');
    }
}
