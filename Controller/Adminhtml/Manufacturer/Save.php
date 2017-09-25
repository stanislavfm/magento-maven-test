<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Controller\Adminhtml\Manufacturer;

class Save extends \Maven\Test\Controller\Adminhtml\Base
{
    protected $escaper;
    protected $fileDriver;
    protected $phpEnvironmentRequest;

    public function __construct(
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Filesystem\Driver\File $fileDriver,
        \Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->escaper = $escaper;
        $this->fileDriver = $fileDriver;
        $this->phpEnvironmentRequest = $phpEnvironmentRequest;
        parent::__construct($resultRawFactory, $resultPageFactory, $context);
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

        $name = $this->escaper->escapeHtml(
            $this->getRequest()->getParam('name')
        );
        $manufacturer->setName($name);

        $code = $this->escaper->escapeHtml(
            $this->getRequest()->getParam('code')
        );
        $manufacturer->setCode($code);

        $description = $this->escaper->escapeHtml(
            $this->getRequest()->getParam('description')
        );
        $manufacturer->setDescription($description);

        $imageFile = $this->phpEnvironmentRequest->getFiles('image');

        if (!empty($imageFile['name'])) {

            if ($this->validateImage($imageFile)) {

                $imageContent = $this->fileDriver->fileGetContents(
                    $imageFile['tmp_name']
                );

                $manufacturer->setImage($imageContent);

            } else {
                $this->getMessageManager()->addWarningMessage(
                    __('Image hasn\'t been uploaded.')
                );
            }
        }

        $manufacturer->save();

        $this->getMessageManager()->addSuccessMessage(
            __('Manufacturer has been successfully saved.')
        );
        $this->_redirect('*/*/index');
    }

    private function validateImage($image)
    {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (empty($image['tmp_name'])) {
            return false;
        }

        $maxImageSize = 3 * 1024 * 1024;

        if ($image['size'] > $maxImageSize) {
            return false;
        }

        $acceptableTypes = [
            'image/jpeg',
            'image/png',
            'image/bmp',
            'image/gif',
            'image/tiff',
        ];

        if (!in_array($image['type'], $acceptableTypes)) {
            return false;
        }

        return true;
    }
}