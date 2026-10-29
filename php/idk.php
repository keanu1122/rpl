<?php

/**
 * Fungsi untuk menghitung bonus saldo berdasarkan nominal setoran bulanan.
 * Jika setoran bulanan >= Rp 500.000, mendapat bonus Rp 50.000.
 * Jika setoran bulanan >= Rp 200.000, mendapat bonus Rp 20.000.
 */
function hitungBonusSetoran($setoranBulanan) {
    if ($setoranBulanan >= 500000) {
        return 50000;
    } elseif ($setoranBulanan >= 200000) {
        return 20000;
    } else {
        return 0; // Tidak mendapat bonus jika setoran di bawah Rp 200.000
    }
}

/**
 * Fungsi utama untuk mensimulasikan dan mencetak pertumbuhan saldo tabungan
 */
function simulasiTabunganAnak($namaAnak, $saldoAwal, $setoranBulanan, $jumlahBulan) {
    $bonusBulan = hitungBonusSetoran($setoranBulanan);

    echo "=========================================================\n";
    echo "         SIMULASI PERTUMBUHAN TABUNGAN ANAK             \n";
    echo "=========================================================\n";
    echo "Nama Anak       : " . $namaAnak . "\n";
    echo "Saldo Awal      : Rp " . number_format($saldoAwal, 0, ',', '.') . "\n";
    echo "Setoran / Bulan : Rp " . number_format($setoranBulanan, 0, ',', '.') . "\n";
    
    if ($bonusBulan > 0) {
        echo "Bonus / Bulan   : Rp " . number_format($bonusBulan, 0, ',', '.') . " (Memenuhi Target Setoran)\n";
    } else {
        echo "Bonus / Bulan   : Rp 0 (Setoran belum mencapai batas minimal bonus)\n";
    }

    echo "Lama Simulasi   : " . $jumlahBulan . " Bulan\n";
    echo "---------------------------------------------------------\n";
    echo "Rincian Pertumbuhan Saldo Bulanan:\n";

    $saldoBerjalan = $saldoAwal;
    $totalSetoran = 0;
    $totalBonus = 0;

    // Perulangan untuk mensimulasikan pertumbuhan saldo dari bulan ke bulan
    for ($bulan = 1; $bulan <= $jumlahBulan; $bulan++) {
        $totalSetoran += $setoranBulanan;
        $totalBonus += $bonusBulan;
        
        // Saldo bertambah dari setoran harian/bulanan + bonus
        $saldoBerjalan += ($setoranBulanan + $bonusBulan);

        echo "- Bulan ke-{$bulan} : Setoran Rp " . number_format($setoranBulanan, 0, ',', '.') .
             " | Bonus: Rp " . number_format($bonusBulan, 0, ',', '.') .
             " | Saldo Akhir: Rp " . number_format($saldoBerjalan, 0, ',', '.') . "\n";
    }

    echo "---------------------------------------------------------\n";
    echo "Total Setoran Murni : Rp " . number_format($totalSetoran, 0, ',', '.') . "\n";
    echo "Total Akumulasi Bonus: Rp " . number_format($totalBonus, 0, ',', '.') . "\n";
    echo "=========================================================\n";
    echo "TOTAL SALDO AKHIR   : Rp " . number_format($saldoBerjalan, 0, ',', '.') . "\n";
    echo "=========================================================\n\n";
}

// --- CONTOH PENGGUNAAN PROGRAM ---

// Kasus 1: Budi menabung Rp 250.000/bulan selama 6 bulan (Mendapat bonus Rp 20.000/bulan)
simulasiTabunganAnak("Budi", 500000, 250000, 6);

// Kasus 2: Ani menabung Rp 500.000/bulan selama 4 bulan (Mendapat bonus Rp 50.000/bulan)
simulasiTabunganAnak("Ani", 1000000, 500000, 4);

?>