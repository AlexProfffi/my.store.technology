<?php

namespace App\Services\Rental\MovieTag;

abstract class MovieTag
{
    abstract public function getCost(int $days): float;

    abstract public static function getTagName(): string;

    public function getPoints(int $days): int
    {
        return 1;
    }

    /**
     * @return array<int, string>
     */
    public static function getClassNames(): array
    {
        $classNames = [];
        $files = scandir(__DIR__);

        $currentClassParts = explode('\\', __CLASS__);
        $excludedClass = array_pop($currentClassParts);

        foreach ($files as $file) {

            $pathInfo = pathinfo($file);

            if($pathInfo['extension'] === 'php') {

                if($pathInfo['filename'] !== $excludedClass)
                {
                    $classNames[] =
                        __NAMESPACE__ . '\\' . $pathInfo['filename'];
                }
                else
                    unset($classNames[$excludedClass]);
            }
        }

        return $classNames;
    }
}
