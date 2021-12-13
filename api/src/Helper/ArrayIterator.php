<?php
namespace App\Helper;

class ArrayIterator
{
    public static function map(iterable $iterable, callable $callable): array
    {
        $result = [];

        foreach ($iterable as $key => $value) {
            $result[$key] = $callable($value, $key);
        }

        return $result;
    }
}