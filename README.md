# SilverStripe Image Quality


## Introduction

This extension adds a Quality method to images, that can be used to reduce the quality of images on a per-occurrence basis.

Higher quality images are larger, so reducing the quality will likely reduce the amount of data needed to be downloaded.

## Requirements

* SilverStripe 4

## Installation

```bash
composer require chrometoaster/silverstripe-image-quality:~1.0
```

The instance gets automatically applied to `Silverstripe\Assets\Image` class.

## Usage

You can define the image quality when outputting images in your templates by calling the `Quality(X)` method
and passing in the desired image quality from 1 to 100.

It's highly recommended that Quality is always defined as the final image manipulation method - see the note below.

```html
<img src="{$Image.Quality(50).Link}" />

<img src="{$Image.CroppedImage(300, 300).Quality(65).Link}" />
``` 

### Implementation notes

SilverStripe applies each configured operation in order, generating a file for each operation.

This is why the Quality method cannot be used to raise the quality of image processing for the entire chain.
Each operation is applied with the default quality, then the Quality method causes a larger file to be generated,
containing the lower quality output from the previous operations.

This is also the reason why the Quality method must be the last in any chain; if it is not, then methods following
Quality will act on a reduced quality image, but the output from those methods will be saved at the default quality,
making the file both lower quality and larger than it would have been.

In theory, it would possible to control the image quality throughout the chain, but the way that SilverStripe caches
intermediate results could cause unexpected side effects, as the quality of the image at intermediate stages would then
depend on which method chain happened to render it first.

## Licence

BSD-3-Clause
