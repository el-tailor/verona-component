<?php

namespace Verona\Component\Console;

final class Console {

    public const int COLOR_BLACK = 30;
    public const int COLOR_RED = 31;
    public const int COLOR_YELLOW = 33;
    public const int COLOR_GREEN = 32;
    public const int COLOR_WHITE = 37;
    public const int COLOR_BLUE = 34;

    public const int BACKGROUND_COLOR_BLACK = 40;
    public const int BACKGROUND_COLOR_RED = 41;
    public const int BACKGROUND_COLOR_YELLOW = 43;
    public const int BACKGROUND_COLOR_WHITE = 47;
    public const int BACKGROUND_COLOR_GREEN = 42;


    public static function write(string $text, int $color = self::COLOR_WHITE, int $background = self::BACKGROUND_COLOR_BLACK) {
        echo "\033[1;$color;".$background."m" . $text . "\033[0m";
    }

    public static function writeLine(string $text, int $color = self::COLOR_WHITE, int $background = self::BACKGROUND_COLOR_BLACK) {
        echo "\033[1;$color;".$background."m" . $text . "\033[0m\n";
    }

}