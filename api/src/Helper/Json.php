<?php
namespace App\Helper;

class Json
{
    public static function parse(string $content): array
    {
        $json = json_decode($content, true);

        if (!$json) {
            throw new \UnexpectedValueException('Failed to parse');
        }

        return $json;
    }

    public static function stringify(array $json): string
    {
        $content = json_encode($json);

        if (!$content) {
            throw new \UnexpectedValueException('Failed to stringify');
        }

        return $content;
    }
}