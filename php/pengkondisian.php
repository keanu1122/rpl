<?php

/**
 * Fungsi untuk menentukan tarif lembur per jam berdasarkan golongan karyawan
 */
function getTarifLemburPerJam($golongan) {
    $gol = strtoupper($golongan);

    if ($gol == "A") {
        return 35000;
    } elseif ($gol == "B") {
        return 25000;
    } elseif ($gol == "C") {
        return 15000;
    } else {
        return 0; // Golongan tidak dikenali
    }
}

/**
 * Fungsi utama untuk menghitung akumulasi gaji dan bonus lembur
 */
function hitungGajiDanLembur($nama, $golongan, $gajiPokokHarian, $jumlahHariKerja, $dataJamLembur) {
    $tarifLemburPerJam = getTarifLemburPerJam($golongan);

    // Validasi golongan
    if ($tarifLemburPerJam == 0) {
        echo "Golongan '{$golongan}' tidak valid.\n";
        return;
    }

    echo "================================================\n";
    echo "         RINCIAN GAJI & LEMBUR KARYAWAN          \n";
    echo "================================================\n";
    echo "Nama Karyawan    : " . $nama . "\n";
    echo "Golongan         : " . strtoupper($golongan) . "\n";
    echo "Gaji Pokok/Hari  : Rp " . number_format($gajiPokokHarian, 0, ',', '.') . "\n";
    echo "Tarif Lembur/Jam : Rp " . number_format($tarifLemburPerJam, 0, ',', '.') . "\n";
    echo "Total Hari Kerja : " . $jumlahHariKerja . " Hari\n";
    echo "------------------------------------------------\n";
    echo "Rincian Lembur Harian:\n";

    $totalGajiPokok = 0;
    $totalBonusLembur = 0;

    // Perulangan untuk menghitung akumulasi gaji pokok dan lembur harian
    for ($i = 1; $i <= $jumlahHariKerja; $i++) {
        // Akumulasi gaji pokok
        $totalGajiPokok += $gajiPokokHarian;

        // Mengambil jam lembur pada hari ke-i (jika ada data)
        $jamLemburHariIni = isset($dataJamLembur[$i - 1]) ? $dataJamLembur[$i - 1] : 0;
        
        // Perhitungan bonus lembur hari ini
        $bonusLemburHariIni = $jamLemburHariIni * $tarifLemburPerJam;
        $totalBonusLembur += $bonusLemburHariIni;

        echo "- Hari ke-{$i} : {$jamLemburHariIni} Jam Lembur -> Bonus: Rp " . number_format($bonusLemburHariIni, 0, ',', '.') . "\n";
    }

    $totalPendapatan = $totalGajiPokok + $totalBonusLembur;

    echo "------------------------------------------------\n";
    echo "Total Gaji Pokok  : Rp " . number_format($totalGajiPokok, 0, ',', '.') . "\n";
    echo "Total Bonus Lembur: Rp " . number_format($totalBonusLembur, 0, ',', '.') . "\n";
    echo "================================================\n";
    echo "TOTAL PENDAPATAN  : Rp " . number_format($totalPendapatan, 0, ',', '.') . "\n";
    echo "================================================\n\n";
}

// --- CONTOH PENGGUNAAN PROGRAM ---

// Data Input Karyawan 1:
// Budi (Golongan A), Gaji Pokok Rp 150.000/hari, Kerja 5 hari.
// Data lembur per hari (dalam jam): Hari 1 = 2 jam, Hari 2 = 0 jam, Hari 3 = 3 jam, Hari 4 = 1 jam, Hari 5 = 0 jam
$jamLemburBudi = [2, 0, 3, 1, 0];
hitungGajiDanLembur("Budi Santoso", "A", 150000, 5, $jamLemburBudi);

// Data Input Karyawan 2:
// Siti (Golongan B), Gaji Pokok Rp 120.000/hari, Kerja 4 hari.
$jamLemburSiti = [1, 2, 2, 0];
hitungGajiDanLembur("Siti Aminah", "B", 120000, 4, $jamLemburSiti);

?>