<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Block\Manufacturer;

use Magento\Framework\View\Element\Template;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Maven_Test::view.phtml';

    protected $objectManager;

    /**
     * @var \Maven\Test\Model\Manufacturer[]
     */
    private $_manufacturers = [];

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Template\Context $context,
        array $data = []
    ) {
        $this->objectManager = $objectManager;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();

        /**
         * @var \Maven\Test\Model\ResourceModel\Manufacturer\Collection $collection
         */
        $collection = $this->objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->getCollection();

        $collection->addOrder(
            'updated_at', \Magento\Framework\Data\Collection::SORT_ORDER_DESC
        );

        $this->_manufacturers = $collection->toArray();
    }

    public function getManufacturers()
    {
        return $this->_manufacturers['items'];
    }

    public function hasManufacturers()
    {
        return $this->_manufacturers['totalRecords'] > 0;
    }

    public function getViewDetailsUrl($id)
    {
        return $this->getUrl(
            '*/*/view',
            [
                'id' => $id
            ]
        );
    }
}