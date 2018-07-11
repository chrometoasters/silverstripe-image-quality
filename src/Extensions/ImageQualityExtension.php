<?php

namespace Chrometoaster\ImageQuality\Extensions;

use SilverStripe\Assets\Image_Backend;
use SilverStripe\Core\Extension;

/**
 * Class ImageQualityExtension
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

        // Instruct the backend to search for an existing variant and use the callback to provide it if it does not exist.
        return $this->owner->manipulateImage($variant, function (Image_Backend $backend) use ($quality) {
            $backendClone  = clone $backend;
            $resourceClone = clone $backend->getImageResource();

            $backendClone->setQuality($quality);
            $backendClone->setImageResource($resourceClone);

            return $backendClone;
        });
    }
}
