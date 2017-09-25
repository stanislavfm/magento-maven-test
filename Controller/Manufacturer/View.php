<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Manufacturer;

class View extends \Maven\Test\Controller\Base
{
    protected $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->objectManager = $objectManager;
        parent::__construct($resultPageFactory, $context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /**
         * @var \Maven\Test\Model\Manufacturer $manufacturer
         */
        $manufacturer = $this->_objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->load($id);

        if ($manufacturer->isEmpty()) {
            $this->messageManager->addErrorMessage(
                __('There is no such manufacturer.')
            );
            return $this->_redirect('*/*/index');
        }

        $resultPage = $this->resultPageFactory->create();

        $this->prepareTitle($resultPage);
        $resultPage->getConfig()->getTitle()->prepend(
            __('Manufacturer Details')
        );

        return $resultPage;
    }
}