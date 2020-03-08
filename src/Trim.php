<?php
namespace Skybluesofa\ImageBarbershop;

use Skybluesofa\ImageBarbershop\Cuts\CropBalanced;
use Skybluesofa\ImageBarbershop\Cuts\CropCenter;
use Skybluesofa\ImageBarbershop\Cuts\CropEntropy;

class Trim
{
    const CUTS = ['balanced', 'center', 'entropy'];

    public static function makeCut(string $type = 'entropy')
    {
        if (!in_array($type, self::CUTS)) {
            $type = 'entropy';
        }

        if ($type == 'balanced') {
            return new CropBalanced();
        } elseif ($type == 'center') {
            return new CropCenter();
        }

        return new CropEntropy();
    }
}
