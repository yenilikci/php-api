<?php

class MainHelper
{
    static function postVariable($value)
    {
        if (isset($_POST[$value])) {
            return strip_tags($_POST[$value]);
        } else {
            return "";
        }
    }

    static function postIntVariable($value)
    {
        if (isset($_POST[$value])) {
            return intval($_POST[$value]);
        } else {
            return 0;
        }
    }
}
