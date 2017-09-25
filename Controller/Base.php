<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller;

abstract class Base extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    protected function prepareTitle(\Magento\Framework\View\Result\Page $resultPage)
    {
        $resultPage->getConfig()->getTitle()->set(__('Maven Test'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer'));
    }
}