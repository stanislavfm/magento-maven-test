<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class Delete extends \Maven\Test\Controller\Adminhtml\Base
{
    public function execute()
    {
        $ids = $this->getRequest()->getParam('id');

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        /**
         * @var \Maven\Test\Model\Manufacturer $manufacturer
         */
        $manufacturer = $this->_objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        );

        foreach ($ids as $id) {
            $manufacturer->load($id);
            $manufacturer->delete();
        }

        $this->getMessageManager()->addSuccessMessage(
            __('Manufacturer(s) has been successfully deleted.')
        );

        return $this->_redirect('*/*/index');
    }
}