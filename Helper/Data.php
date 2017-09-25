<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Prepares binary image to display
     *
     * @param $image string
     *
     * @return string
     */
    public function getImageSrcInBase64($image)
    {
        $imageInfo = getimagesizefromstring($image);
        $decodedImage = base64_encode($image);

        return "data:{$imageInfo['mime']};base64,{$decodedImage}";
    }
}