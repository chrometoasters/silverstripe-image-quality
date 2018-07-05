<?php

namespace MBIE\ImageQuality\Extension;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\File;

/**
 * Add a Quality method to Images, to be used to reduce the quality (and hence
 * size) of images.
 */
class ImageQualityExtension extends Extension
{
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
