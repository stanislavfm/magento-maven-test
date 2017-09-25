<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class Index extends \Maven\Test\Controller\Adminhtml\Base
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $this->prepareTitle($resultPage);
        $resultPage->getConfig()->getTitle()->prepend('View');

        $block = $resultPage->getLayout()->createBlock(
            'Maven\Test\Block\Adminhtml\Manufacturer\View'
        );

        $this->_addContent($block);

        return $resultPage;
    }
}