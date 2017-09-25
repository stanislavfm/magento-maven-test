<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Model;

class Manufacturer extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Maven\Test\Model\ResourceModel\Manufacturer');
    }

    public function beforeSave()
    {
        $this->setUpdatedAt(
            new \DateTime()
        );

        if ($this->isObjectNew()) {
            $this->setCreatedAt(
                new \DateTime()
            );
        }

        return parent::beforeSave();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @param $name string
     */
    public function setName($name)
    {
        $this->setData('name', $name);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->getData('code');
    }

    /**
     * @param $code string
     */
    public function setCode($code)
    {
        $this->setData('code', $code);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getData('description');
    }

    /**
     * @param $description string
     */
    public function setDescription($description)
    {
        $this->setData('description', $description);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData('image');
    }

    /**
     * @param $image string
     */
    public function setImage($image)
    {
        $this->setData('image', $image);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    /**
     * @param $updatedAt string|\DateTime
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData('updated_at', $updatedAt);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    /**
     * @param $createdAt string|\DateTime
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData('created_at', $createdAt);
    }
}