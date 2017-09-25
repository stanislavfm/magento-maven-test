<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Model\ResourceModel\Manufacturer;

class Collection
    extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            'Maven\Test\Model\Manufacturer',
            'Maven\Test\Model\ResourceModel\Manufacturer'
        );
    }
}