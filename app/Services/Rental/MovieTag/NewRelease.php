<?php

namespace App\Services\Rental\MovieTag;

class NewRelease extends MovieTag
{
    public static function getTagName(): string
    {
        return 'New Release';
    }

    public function getCost(int $days): float
    {
        return $days * 3;
    }

    public function getPoints(int $days): int
    {
        return ($days > 1) ? 2 : 1;
    }
}
