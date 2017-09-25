<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class GetGridHtml extends \Maven\Test\Controller\Adminhtml\Base
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $block = $resultPage->getLayout()->createBlock(
            'Maven\Test\Block\Adminhtml\Manufacturer\View\Grid'
        );

        /**
         * @var \Magento\Framework\Controller\Result\Raw $result
         */
        $result = $this->resultRawFactory->create();
        $result->setContents($block->toHtml());

        return $result;
    }
}