<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Block\Manufacturer\View;

use Magento\Framework\View\Element\Template;

class Details extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'Maven_Test::view/details.phtml';

    protected $dataHelper;
    protected $objectManager;

    /**
     * @var \Maven\Test\Model\Manufacturer
     */
    private $_manufacturer = null;

    public function __construct(
        \Maven\Test\Helper\Data $dataHelper,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Template\Context $context,
        array $data = []
    ) {
        $this->dataHelper = $dataHelper;
        $this->objectManager = $objectManager;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();

        $id = $this->getRequest()->getParam('id');

        $this->_manufacturer = $this->objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->load($id);
    }

    public function getName()
    {
        return $this->_manufacturer->getName();
    }

    public function getCode()
    {
        return $this->_manufacturer->getCode();
    }

    public function hasDescription()
    {
        return !empty($this->getDescription());
    }

    public function getDescription()
    {
        return $this->_manufacturer->getDescription();
    }

    public function hasImage()
    {
        return !empty($this->_manufacturer->getImage());
    }

    public function getImageSrc()
    {
        return $this->dataHelper->getImageSrcInBase64(
            $this->_manufacturer->getImage()
        );
    }

    public function getUpdatedAt()
    {
        return $this->_manufacturer->getUpdatedAt();
    }

    public function getCreatedAt()
    {
        return $this->_manufacturer->getCreatedAt();
    }
}