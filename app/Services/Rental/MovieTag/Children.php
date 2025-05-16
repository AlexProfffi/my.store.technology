<?php

namespace App\Services\Rental\MovieTag;

class Children extends MovieTag
{
    public static function getTagName(): string
    {
        return 'Children';
    }

    public function getCost(int $days): float
    {
        $result = 1.5;

        if($days > 3) {
            $result += ($days - 3) * 1.5;
        }

        return $result;
    }
}
