<?php
namespace Skybluesofa\ImageBarbershop\Tests;

use Skybluesofa\ImageBarbershop\Cuts\CropEntropy;
use PHPUnit\Framework\TestCase;

class ClassEntropyTest extends TestCase
{
    
    const EXAMPLE_IMAGE = '/images/side.png';

    /** @var string */
    protected $tempDir = '';
    
    public function setUp() : void
    {
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped('The imagick extension is not available.');
            return;
        }
        $this->tempDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'croptest';
             
        if (file_exists($this->tempDir)) {
            $this->cleanup();
        }
         
        if (!mkdir($this->tempDir)) {
            $this->markTestSkipped('Can\'t create temp directory '. $this->tempDir .' skipping test');
        }
    }
    
    public function tearDown() :void
    {
        $this->cleanup();
    }
    
    public function testEntropy()
    {
        $croppedImage = (new CropEntropy)->onFile(__DIR__ . self::EXAMPLE_IMAGE)->getResults(200, 200);
        $croppedImage->writeimage($this->tempDir . DIRECTORY_SEPARATOR . 'entropy-test.png');

        $expectedImage = new \Imagick(__DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'entropy-expected.png');
        $this->assertEquals($expectedImage, $croppedImage);
    }
    
    public function testEntropyWithPreviousImagick()
    {
        $image = new \Imagick(__DIR__ . self::EXAMPLE_IMAGE);

        $croppedImage = (new CropEntropy)->onImage($image)->toSize(200, 200)->getResults();
        $croppedImage->writeimage($this->tempDir . DIRECTORY_SEPARATOR . 'entropy-test.png');

        $this->assertSame($image, $croppedImage);
    }

    private function cleanup()
    {
        foreach (glob($this->tempDir . DIRECTORY_SEPARATOR . '*') as $file) {
            unlink($file);
        }

        rmdir($this->tempDir);
    }
}
