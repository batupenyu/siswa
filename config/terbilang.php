<?php

// config for Riskihajar/Terbilang
return [
    /*
    |--------------------------------------------------------------------------
    | Date Output Format
    |--------------------------------------------------------------------------
    |
    | This value is output format for function Terbilang::date()
    | default date format is '{DAY} {MONTH} {YEAR}'
    | default time format is '{HOUR} {SEPARATOR} {MINUTE} {MINUTE_LABEL} {SECOND} {SECOND_LABEL}'
    | you can mondify for example 'day {DAY} month {MONTH} year {YEAR}'
    */
    'output' => [
        'date' => '{DAY} {MONTH} {YEAR}',
        'time' => '{HOUR} {SEPARATOR} {MINUTE} {MINUTE_LABEL} {SECOND} {SECOND_LABEL}',
    ],

    /**
     * Locale
     * if you want to change locale for output this package only
     * but want keep app using default locale
     */
    'locale' => 'id',
    'language' => 'id',


    /**
     * use intl module if enabled
     * just disabled if you want use native intl module php
     * look : https://www.php.net/manual/en/class.numberformatter.php#numberformatter.constants.spellout
     */
    'use_intl' => true,

    /*
    |--------------------------------------------------------------------------
    | Distance Between Date Output Format
    |--------------------------------------------------------------------------
    |
    | This value is output template for function Terbilang::distance()
    | default template FULL, available template FULL, YEAR, MONTH, DAY, HOUR, MINUTE, SECOND
    */
    'distance' => [
        'type' => \Riskihajar\Terbilang\Enums\DistanceDate::Day,
        'template' => '{YEAR} {MONTH} {DAY} {HOUR} {MINUTE} {SECOND}',
        'hide_zero_value' => true,
        'separator' => ' ',
        'terbilang' => false,
        'show' => [
            'year' => true,
            'month' => true,
            'day' => true,
            'hour' => true,
            'minute' => true,
            'second' => true,
        ],
    ],
];
