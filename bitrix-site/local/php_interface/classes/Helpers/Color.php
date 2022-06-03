<?php


namespace ITLeague\Helpers;


class Color
{
    public static function set(string $color): void
    {
        $color = substr(ltrim(trim($color), '#'), 0, 6);
        app()->SetPageProperty('COLOR', "style='--color:#$color'");
    }
}
