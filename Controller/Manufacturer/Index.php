<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Manufacturer;

class Index extends \Maven\Test\Controller\Base
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $this->prepareTitle($resultPage);
        $resultPage->getConfig()->getTitle()->set(__('View'));

        return $resultPage;
    }
}