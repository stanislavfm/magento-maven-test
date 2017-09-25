<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml;

use Magento\Framework\App\ResponseInterface;

abstract class Base extends \Magento\Backend\App\Action
{
    protected $resultRawFactory;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    protected function prepareTitle(\Magento\Framework\View\Result\Page $resultPage)
    {
        $resultPage->getConfig()->getTitle()->set(__('Maven Test'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer'));
    }
}