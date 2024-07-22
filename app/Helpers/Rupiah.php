<?php
if (!function_exists('rupiah')) {
    function selisih($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
}