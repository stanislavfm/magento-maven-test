<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Block\Adminhtml\Manufacturer\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $dataHelper;
    protected $objectManager;

    public function __construct(
        \Maven\Test\Helper\Data $dataHelper,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->dataHelper = $dataHelper;
        $this->objectManager = $objectManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $id = $this->getRequest()->getParam('id');

        /**
         * @var \Maven\Test\Model\Manufacturer $manufacturer
         */
        $manufacturer = $this->objectManager->create(
            '\Maven\Test\Model\Manufacturer'
        )->load($id);

        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'      => 'edit_form',
                    'action'  => $this->getUrl('*/*/save'),
                    'method'  => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );

        $fieldset = $form->addFieldset(
            'fieldset',
            [
                'legend' => __('')
            ]
        );

        $fieldset->addField(
            'id',
            'hidden',
            [
                'name'  => 'id',
                'value' => $manufacturer->getId()
            ]
        );

        $fieldset->addField(
            'name',
            'text',
            [
                'label'    => __('Name'),
                'name'     => 'name',
                'required' => true,
                'value'    => $manufacturer->getName()
            ]
        );

        $fieldset->addField(
            'code',
            'text',
            [
                'label'    => __('Code'),
                'name'     => 'code',
                'class'    => 'validate-digits',
                'required' => true,
                'value'    => $manufacturer->getCode(),
                'note'     => __('Must consist of digits.')
            ]
        );

        $fieldset->addField(
            'description',
            'textarea',
            [
                'label' => __('Description'),
                'name'  => 'description',
                'value' => $manufacturer->getDescription()
            ]
        );

        $beforeElementHtml = '';

        if ($manufacturer->getImage()) {

            $src = $this->dataHelper->getImageSrcInBase64(
                $manufacturer->getImage()
            );

            $beforeElementHtml = <<<HTML
<div>
    <img 
        style="max-width: 200px; max-height: 200px; margin-bottom: 10px;" 
        src="{$src}" 
    />
</div>
HTML;
        }

        $fieldset->addField(
            'image',
            'imagefile',
            [
                'label' => __('Image'),
                'name'  => 'image',
                'note'  => __('Maximum 3 Mb.'),
                'before_element_html' => $beforeElementHtml
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}