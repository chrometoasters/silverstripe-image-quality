<?php

namespace Chrometoaster\ImageQuality\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\File;

/**
 * Class ImageQualityExtension
 * @package Chrometoaster\ImageQuality\Extensions
 */
class ImageQualityExtension extends Extension
{
    /**
     * This function adjusts the quality of of an image using SilverStripe 4 syntax.
     *
     * @param $quality
     * @return mixed
     */
    public function Quality($quality)
    {
        // Generate variant key
        $variant = $this->owner->variantName(__FUNCTION__, $quality);

        // Instruct the backend to search for an existing variant and if not callback to generate the image if it does not exist.
        return $this->owner->manipulateImage($variant, function($backend) use ($quality) {
            return $backend->setQuality($quality);
        });
    }
}
