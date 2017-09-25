<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class Edit extends \Maven\Test\Controller\Adminhtml\Base
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $id = $this->getRequest()->getParam('id');

        /**
         * @var \Maven\Test\Model\Manufacturer $manufacturer
         */
        $manufacturer = $this->_objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->load($id);

        $this->prepareTitle($resultPage);

        if ($manufacturer->isEmpty()) {
            $resultPage->getConfig()->getTitle()->prepend(__('New Manufacturer'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(
                __('Edit Manufacturer "%1"', $manufacturer->getName())
            );
        }

        $block = $resultPage->getLayout()->createBlock(
            'Maven\Test\Block\Adminhtml\Manufacturer\Edit'
        );

        $this->_addContent($block);

        return $resultPage;
    }
}