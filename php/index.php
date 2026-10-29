<?php

/**
 * Fungsi untuk menentukan tarif harian berdasarkan jenis mobil
 */
function getTarifHarian($jenisMobil) {
    // Normalisasi input ke huruf kecil untuk menghindari error akibat kapitalisasi
    $jenis = strtolower($jenisMobil);

    if ($jenis == "sedan") {
        return 300000;
    } elseif ($jenis == "suv") {
        return 500000;
    } elseif ($jenis == "mpv") {
        return 400000;
    } else {
        return 0; // Tarif 0 jika jenis mobil tidak dikenali
    }
}

/**
 * Fungsi utama untuk menghitung dan mencetak rincian biaya sewa
 */
function cetakRincianSewa($jenisMobil, $lamaLamaHari) {
    $tarifHarian = getTarifHarian($jenisMobil);

    // Validasi jika jenis mobil tidak valid
    if ($tarifHarian == 0) {
        echo "Jenis mobil '{$jenisMobil}' tidak ditemukan dalam sistem.\n";
        return;
    }

    echo "========================================\n";
    echo "       RINCIAN BIAYA SEWA MOBIL         \n";
    echo "========================================\n";
    echo "Jenis Mobil : " . ucfirst($jenisMobil) . "\n";
    echo "Tarif / Hari: Rp " . number_format($tarifHarian, 0, ',', '.') . "\n";
    echo "Lama Sewa   : " . $lamaLamaHari . " Hari\n";
    echo "----------------------------------------\n";
    echo "Rincian Sewa Harian:\n";

    $totalKotor = 0;

    // Perulangan untuk mencetak biaya tiap hari
    for ($i = 1; $i <= $lamaLamaHari; $i++) {
        $totalKotor += $tarifHarian;
        echo "- Hari ke-{$i} : Rp " . number_format($tarifHarian, 0, ',', '.') . "\n";
    }

    // Pengkondisian untuk memeriksa diskon (diskon 10% jika sewa > 3 hari)
    $diskon = 0;
    if ($lamaLamaHari > 3) {
        $diskon = 0.10 * $totalKotor; // 10% diskon
    }

    $totalBayar = $totalKotor - $diskon;

    echo "----------------------------------------\n";
    echo "Subtotal     : Rp " . number_format($totalKotor, 0, ',', '.') . "\n";
    
    if ($diskon > 0) {
        echo "Diskon (10%) : -Rp " . number_format($diskon, 0, ',', '.') . "\n";
    } else {
        echo "Diskon (0%)  : Rp 0\n";
    }

    echo "========================================\n";
    echo "TOTAL BAYAR  : Rp " . number_format($totalBayar, 0, ',', '.') . "\n";
    echo "========================================\n\n";
}

// --- CONTOH PENGGUNAAN PROGRAM ---

// Kasus 1: Sewa SUV selama 5 Hari (Mendapat diskon 10%)
cetakRincianSewa("SUV", 5);

// Kasus 2: Sewa Sedan selama 2 Hari (Tidak mendapat diskon)
cetakRincianSewa("Sedan", 2);

?>