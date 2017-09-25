<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class NewAction extends \Maven\Test\Controller\Adminhtml\Base
{
    public function execute()
    {
        $this->_forward('edit');
    }
}