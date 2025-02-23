<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka) {
        $hasil = number_format($angka, 2, ',', '.');
        return 'Rp ' . $hasil;
    }
}