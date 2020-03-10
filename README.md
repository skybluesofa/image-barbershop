# Crop

This is a small set of automated image croppers.

## Requirements

 - PHP 7.2+ with Imagick extension

## Description

This project includes three functional image cropers:

### CropEntropy

This is the default crop.

```
// Use the CropEntropy class directly
$croppedImage = (new CropEntropy)->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

or 

```
// Use the Trim class and explicit cut type
$croppedImage = Trim::makeCut('entropy')->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

or 

```
// Use the Trim class and implicit (default) cut type
$croppedImage = Trim::makeCut()->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

This class finds the a position in the picture with the most "energy" in it. Energy (or entropy) in
images are defined by 'edginess' in the image. For example a image of the sky have low edginess and
an image of an anthill has very high edginess.

Energy is in this case calculated like this

  1. Take the image and turn it into black and white
  2. Run a edge filter so that we're left with only edges.
  3. Find a piece in the picture that has the highest entropy (i.e. most edges)
  4. Return coordinates that makes sure that this piece of the picture is not cropped 'away'
  
### CropCenter
```
// Use the CropCenter class directly
$croppedImage = (new CropCenter)->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

or 

```
// Use the Trim class and explicit cut type
$croppedImage = Trim::makeCut('center')->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

This is the most basic of cropping techniques:

  1. Find the exact center of the image
  2. Trim any edges that is bigger than the targetWidth and targetHeight

### CropBalanced

```
// Use the CropBalanced class directly
$croppedImage = (new CropBalanced)->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

or 

```
// Use the Trim class and explicit cut type
$croppedImage = Trim::makeCut('balanced')->onFile('image.jpg')->getResults(200, 200); // \Imagick image
$croppedImage->writeimage('image-cropped.jpg');
```

Crop balanced is a variant of CropEntropy where I tried to the cropping a bit more balanced.

  1. Dividing the image into four equally squares
  2. Find the most energetic point per square
  3. Finding the images weighted mean interest point for all squares