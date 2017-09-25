<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Block\Adminhtml\Manufacturer\View;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $dataHelper;
    protected $objectManager;

    public function __construct(
        \Maven\Test\Helper\Data $dataHelper,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        array $data = []
    ) {
        $this->dataHelper = $dataHelper;
        $this->objectManager = $objectManager;
        parent::__construct($context, $backendHelper, $data);
    }

    public function _construct()
    {
        parent::_construct();

        $this->setId('MavenTestManufacturerViewGrid');

        $this->setDefaultSort('created_at');
        $this->setDefaultDir(\Magento\Framework\Data\Collection::SORT_ORDER_DESC);

        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'title',
            [
                'header'    => __('Name'),
                'type'      => 'text',
                'index'     => 'name',
            ]
        );

        $this->addColumn(
            'code',
            [
                'header'    => __('Code'),
                'type'      => 'text',
                'index'     => 'code',
            ]
        );

        $this->addColumn(
            'description',
            [
                'header'    => __('Description'),
                'type'      => 'text',
                'index'     => 'description',
            ]
        );

        $this->addColumn(
            'image',
            [
                'header'    => __('Image'),
                'type'      => 'text',
                'sortable'  => false,
                'filter'    => false,
                'frame_callback' => [$this, 'callbackColumnTitle'],
            ]
        );

        $this->addColumn(
            'updated_ad',
            [
                'header'    => __('Updated At'),
                'type'      => 'datetime',
                'format'    => \IntlDateFormatter::SHORT,
                'index'     => 'updated_at',
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header'    => __('Created At'),
                'type'      => 'datetime',
                'format'    => \IntlDateFormatter::SHORT,
                'index'     => 'created_at',
            ]
        );

        $this->addColumn(
            'actions',
            [
                'header'    => __('Actions'),
                'type'      => 'action',
                'filter'    => false,
                'sortable'  => false,
                'getter'    => 'getId',
                'actions'   => [
                    [
                        'caption'   => __('Edit'),
                        'url'       => ['base' => '*/*/edit'],
                        'field'     => 'id'
                    ],
                    [
                        'caption'   => __('Delete'),
                        'url'       => ['base' => '*/*/delete'],
                        'field'     => 'id',
                        'confirm'   => __('Are you sure?')
                    ],
                ]
            ]
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('*/*/delete'),
                'confirm' => __('Are you sure?')
            ]
        );

        return parent::_prepareMassaction();
    }

    public function callbackColumnTitle($value, $row, $column, $isExport)
    {
        $image = $row->getImage();

        if (empty($image)) {
            return '<i>' . __('No image.') . '</i>';
        }

        $src = $this->dataHelper->getImageSrcInBase64($image);

        return <<<HTML
<img style="max-width: 200px; max-height: 200px" src="{$src}" />
HTML;
    }

    public function getGridUrl()
    {
        return $this->getUrl(
            '*/*/getGridHtml',
            [
                '_current' => true
            ]
        );
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            '*/*/edit',
            [
                'id' => $row->getId()
            ]
        );
    }
}