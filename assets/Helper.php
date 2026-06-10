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

        // Return raw numbers for formatMoney to handle formatting
        return [
            'price' => (int)$price,
            'total' => (int)$total_price
        ];
    }

    public static function formatMoney($number)
    {
        if (empty($number) || $number == 0)
            return 0;

        if ($number >= 1000000000) {
            $formatted = $number / 1000000000;
            return ($formatted >= 10) ? number_format($formatted, 0) . 'B' : number_format($formatted, 1) . 'B';
        } else if ($number >= 1000000) {
            $formatted = $number / 1000000;
            return ($formatted >= 10) ? number_format($formatted, 0) . 'M' : number_format($formatted, 1) . 'M';
        } else if ($number >= 1000) {
            $formatted = $number / 1000;
            // If this would round to 1000K or more, show in M instead
            $rounded = round($formatted, 0);
            if ($rounded >= 1000) {
                $formatted = $number / 1000000;
                return number_format($formatted, 1) . 'M';
            }
            return ($formatted >= 10) ? number_format($formatted, 0) . 'K' : number_format($formatted, 1) . 'K';
        }

        return $number;
    }

}