<?php

namespace app\assets;

class Helper {

    public static function printDatetime($datetime, $format = "%b %d, %Y") {
        if (empty($datetime))
            return "";

        $timestamp = strtotime($datetime);
        return strftime($format, $timestamp);
    }

}