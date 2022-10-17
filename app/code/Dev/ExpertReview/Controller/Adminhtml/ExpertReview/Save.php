<?php

namespace Dev\ExpertReview\Controller\Adminhtml\ExpertReview;

use Dev\ExpertReview\Model\ExpertReviewFactory;
use Exception;
use Magento\Backend\App\Action;

class Save extends Action
{
    private $expertReviewFactory;

    public function __construct(
        Action\Context $context,
        ExpertReviewFactory    $expertReviewFactory
    ) {
        parent::__construct($context);
        $this->expertReviewFactory = $expertReviewFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['expert_review_id']) ? $data['expert_review_id'] : null;

        $newData = [
            'title' => $data['title'],
            'detail' => $data['detail'],
            'video' => $data['video'],
            'short_description' => $data['short_description'],
        ];

        $expertReview = $this->expertReviewFactory->create();

        if ($id) {
            $expertReview->load($id);
        }
        try {
            $expertReview->addData($newData);
            $expertReview->save();
            $this->getMessageManager()->addSuccessMessage(__('You saved.'));
            return $this->resultRedirectFactory->create()->setPath('expertreivew/expertreivew/index');
        } catch (Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Error'));
        }
    }
}
