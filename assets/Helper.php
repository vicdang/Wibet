<?php

namespace app\assets;

class Helper {

    public static function printDatetime($datetime, $format = "%b %d, %Y") {
        if (empty($datetime))
            return "";

        $timestamp = strtotime($datetime);
        return strftime($format, $timestamp);
    }

    public static function calculatePrices($total, $rate, $count)
    {
        // Calculate price
        $price = $total / 100 * $rate;

        // Calculate total price
        $total_price = $price * $count;

        // Return the results as an array
        return [
            'price' => number_format($price,0),
            'total' => number_format($total_price,0)
        ];
    }

}