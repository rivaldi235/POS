<?php
if (!function_exists('activeSegment')) {
    function activeSegment($name, $segment = 2, $class = 'active')
    {
        return request()->segment($segment) == $name ? $class : '';
    }
}

if (! function_exists('format_price')) {
    function format_harga($harga)
    {
        return 'Rp. '. number_format($harga, 0, ',', '.');
    }
}

function convertDate($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}