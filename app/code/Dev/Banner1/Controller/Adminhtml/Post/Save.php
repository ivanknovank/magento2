<?php

namespace Dev\Banner1\Controller\Adminhtml\Post;

use Dev\Banner1\Model\PostFactory;
use Exception;
use Magento\Backend\App\Action;

class Save extends Action
{
    private $postFactory;

    public function __construct(
        Action\Context $context,
        PostFactory    $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['banner_id']) ? $data['banner_id'] : null;

        $newData = [
            'name' => $data['name'],
            'short_description' => $data['short_description'],
            'image' => $data['image'],
            'status' => $data['status'],
            'display_position' => $data['display_position'],
            'date' => $data['date'],
        ];

        $post = $this->postFactory->create();

        if ($id) {
            $post->load($id);
        }
        try {
            if (isset($data['image']) && is_array($data['image'])) {
                $strpos = strpos($data['image'][0]['url'], '/media/');
                $data['image'][0]['url'] = substr($data['image'][0]['url'], $strpos + 6);
                $data['image'][0]['url'] = trim($data['image'][0]['url']);
                $newData['image'] = json_encode($data['image']);
                $newData['name_image'] = $data['image'][0]['name'];
                $newData['url_image'] = $data['image'][0]['url'];
            }
            $post->addData($newData);
            $post->save();
            $this->getMessageManager()->addSuccessMessage(__('You saved the post.'));
            return $this->resultRedirectFactory->create()->setPath('banner1/post/index');
        } catch (Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Error'));
            //return $this->resultRedirect->create()->setPath('banner1/post/addnew');
        }
    }
}
