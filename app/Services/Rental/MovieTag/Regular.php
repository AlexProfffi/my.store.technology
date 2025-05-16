<?php

namespace App\Services\Rental\MovieTag;

class Regular extends MovieTag
{
    public static function getTagName(): string
    {
        return 'Regular';
    }

    public function getCost(int $days): float
    {
        $result = 2;

        if($days > 2) {
            $result += ($days - 2) * 1.5;
        }

        return $result;
    }
}
