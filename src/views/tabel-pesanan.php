<?php
include '../layout/header.php'; 
include '../connect.php';

$sql = "SELECT dp.id, dp.nama, dp.jenisKelamin, dp.nik, dp.durasiMenginap, dp.diskon, dp.totalHarga, 
               dk.tipe_kamar, dk.foto
        FROM data_pesanan dp
        JOIN data_kamar dk ON dp.id_kamar = dk.id
        ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../output.css" />
</head>
<body class="p-16">
    <div>
        <div class="mt-16">
            <h1 class="title text-center">
                Pemesanan Kamar
            </h1>
            <div class="flex justify-center pb-32 text-primary">
                <div class="rounded px-8 shadow-lg max-w-lg w-full">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Nama Pemesan 
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['nama'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Nomor Identitas 
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['nik'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Jenis Kelamin 
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['jenisKelamin'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Tipe Kamar 
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['tipe_kamar'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Durasi Penginapan 
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['durasiMenginap'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Diskon
                                </p>
                                <p class=" w-2/3">
                                    <?php echo htmlspecialchars($row['diskon'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Total Bayar
                                </p>
                                <p class="w-2/3">
                                    <?php echo htmlspecialchars($row['totalHarga'] ?? ''); ?>
                                </p>
                            </div>
                            <div class="my-4 flex items-center">
                                <p class="font-semibold w-1/3 text-right pr-4"> 
                                    Foto
                                </p>
                                <p class="w-2/3">
                                    <img src="../<?php echo htmlspecialchars($row['foto'] ?? ''); ?>" alt="">
                                </p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center">Tidak ada data pesanan</td>
                        </tr>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php include '../layout/footer.php'; ?>