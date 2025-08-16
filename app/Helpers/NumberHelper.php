<?php
// File: app/Helpers/NumberHelper.php

namespace App\Helpers;

class NumberHelper
{
    /**
     * Mengonversi angka menjadi representasi kata-kata dalam bahasa Indonesia.
     *
     * @param int $number Angka yang ingin dikonversi.
     * @return string Representasi kata-kata dari angka tersebut.
     */
    public static function terbilang($number)
    {
        // Array kata-kata untuk angka 0 hingga 11
        $words = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

        // Menangani angka kurang dari 12
        if ($number < 12) {
            return $words[$number];
        }

        // Menangani angka antara 12 dan 19
        if ($number < 20) {
            return self::terbilang($number - 10) . " belas";
        }

        // Menangani angka antara 20 dan 99
        if ($number < 100) {
            return self::terbilang(intdiv($number, 10)) . " puluh " . self::terbilang($number % 10);
        }

        // Menangani angka antara 100 dan 199
        if ($number < 200) {
            return "seratus " . self::terbilang($number - 100);
        }

        // Menangani angka antara 200 dan 999
        if ($number < 1000) {
            return self::terbilang(intdiv($number, 100)) . " ratus " . self::terbilang($number % 100);
        }

        // Menangani angka antara 1000 dan 1999
        if ($number < 2000) {
            return "seribu " . self::terbilang($number - 1000);
        }

        // Menangani angka antara 2000 dan 999.999
        if ($number < 1000000) {
            return self::terbilang(intdiv($number, 1000)) . " ribu " . self::terbilang($number % 1000);
        }

        // Menangani angka antara 1.000.000 dan 999.999.999
        if ($number < 1000000000) {
            return self::terbilang(intdiv($number, 1000000)) . " juta " . self::terbilang($number % 1000000);
        }

        // Mengembalikan pesan kesalahan untuk angka di luar rentang yang didukung
        return "Angka terlalu besar!";
    }
}