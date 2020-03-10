<?php
namespace Skybluesofa\ImageBarbershop\Tests;

use Skybluesofa\ImageBarbershop\Trim;
use Skybluesofa\ImageBarbershop\Cuts\CropEntropy;
use PHPUnit\Framework\TestCase;
use Skybluesofa\ImageBarbershop\Cuts\CropBalanced;
use Skybluesofa\ImageBarbershop\Cuts\CropCenter;

class TrimTest extends TestCase
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
    }
    
    public function testTrimDefault()
    {
        $trimType = Trim::makeCut();

        $this->assertInstanceOf(CropEntropy::class, $trimType);
    }
    
    public function testTrimUnknown()
    {
        $trimType = Trim::makeCut('unknown_type');

        $this->assertInstanceOf(CropEntropy::class, $trimType);
    }
    
    public function testTrimEntropy()
    {
        $trimType = Trim::makeCut('entropy');

        $this->assertInstanceOf(CropEntropy::class, $trimType);
    }

    public function testTrimBalanced()
    {
        $trimType = Trim::makeCut('balanced');

        $this->assertInstanceOf(CropBalanced::class, $trimType);
    }

    public function testTrimCenter()
    {
        $trimType = Trim::makeCut('center');

        $this->assertInstanceOf(CropCenter::class, $trimType);
    }
}
