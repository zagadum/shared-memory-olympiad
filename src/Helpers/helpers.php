<?php
if (!function_exists('format_date')) {
    function format_date($date, $format = 'd.m.Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}
//require_once __DIR__ . '/DateHelper.php';
//require_once __DIR__ . '/StringHelper.php';
//require_once __DIR__ . '/ArrayHelper.php';
