<?php
include '../connect.php';

function hitung_total($hargaKamar, $durasiMenginap, $termasukSarapan) {
    $totalHarga = $hargaKamar * $durasiMenginap;
    $diskon = 0;

    if ($durasiMenginap > 3) {
        $diskon = $totalHarga * 0.10;
        $totalHarga -= $diskon;
    }

    if ($termasukSarapan) {
        $totalHarga += $durasiMenginap * 80000;
    }

    return [$totalHarga, $diskon];
}

function tambah_pesanan($data) {
    global $conn;

    $nama = $data['nama'] ?? '';
    $jenisKelamin = $data['jenisKelamin'] ?? '';
    $nik = $data['nik'] ?? '';
    $tipeKamarId = $data['tipe_kamar'] ?? '';
    $tanggalPesan = $data['tanggalPesan'] ?? '';
    $durasiMenginap = $data['durasiMenginap'] ?? '';
    $diskon = $data['diskon'] ?? '';
    $termasukSarapan = isset($data['termasukSarapan']) ? 1 : 0;
    $totalHarga = $data['totalHarga'] ?? '';

    echo $nama;
    echo $jenisKelamin;
    echo $nik;

    $sql = "INSERT INTO data_pesanan (nama, jenisKelamin, nik, id_kamar, tanggalPesan, durasiMenginap, diskon, termasukSarapan, totalHarga) 
            VALUES ('$nama', '$jenisKelamin', '$nik', '$tipeKamarId', '$tanggalPesan', '$durasiMenginap', '$diskon', '$termasukSarapan', '$totalHarga')";

    $result = mysqli_query($conn, $sql);

    return $result;
}

?>
