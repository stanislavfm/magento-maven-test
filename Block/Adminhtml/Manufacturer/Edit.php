<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Block\Adminhtml\Manufacturer;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'Maven_Test';
        $this->_controller = 'adminhtml_manufacturer';

        $this->removeButton('reset');
    }
}