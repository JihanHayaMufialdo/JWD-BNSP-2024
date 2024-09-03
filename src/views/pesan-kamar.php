<?php 
include '../layout/header.php'; 
include '../connect.php';
include '../controller/controller.php';

$harga = '';
$totalHarga = '';
$diskon = '';
$tipeKamarId = '';
$durasiMenginap = '';
$termasukSarapan = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["hitung"])) {
        $tipeKamarId = $_POST["tipe_kamar"] ?? '';
        $durasiMenginap = $_POST["durasiMenginap"] ?? '';
        $termasukSarapan = isset($_POST["termasukSarapan"]);
        $nama = $_POST['nama'] ?? '';
        $jenisKelamin = $_POST['jenisKelamin'] ?? '';
        $nik = $_POST['nik'] ?? '';
        $tanggalPesan = $_POST['tanggalPesan'] ?? '';

        if ($tipeKamarId) {
            $sql = "SELECT harga FROM data_kamar WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $tipeKamarId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $harga = $row['harga'];
            }

            list($totalHarga, $diskon) = hitung_total($harga, $durasiMenginap, $termasukSarapan);
        }
    } elseif (isset($_POST["submit"])) {
        if (tambah_pesanan($_POST)) {
            echo "<script>alert('Pesanan berhasil ditambah'); window.location.href = 'tabel-pesanan.php';</script>";
        } else {
            echo "<script>alert('Gagal menambah pesanan');</script>";
        }
    }
}

$sql = "SELECT id, tipe_kamar, harga FROM data_kamar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kamar</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../output.css" />
</head>
<body class="p-16">
    <div class="mt-16">
        <div class="my-16">
            <h1 class="title text-center">
                Pemesanan Kamar
            </h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex justify-center pb-32 text-primary">
                    <div class="rounded px-8 shadow-lg max-w-lg w-full">
                        <div class="my-8 text-center text-xl font-bold ">
                            <p>Form Pemesanan</p>
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="nama" class="font-semibold w-1/3 text-right pr-4"> 
                                Nama Pemesan 
                            </label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="border w-2/3"
                                value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>"
                                required
                            />
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="jenisKelamin" class="font-semibold w-1/3 text-right pr-4">
                                Jenis Kelamin
                            </label>
                            <input
                                type="radio"
                                id="Laki-Laki"
                                name="jenisKelamin"
                                value="Laki-Laki"
                                <?php echo (isset($_POST['jenisKelamin']) && $_POST['jenisKelamin'] === 'Laki-Laki') ? 'checked' : ''; ?>
                                required
                            />
                            <label for="Laki-Laki"> Laki-Laki </label>
                            <input
                                type="radio"
                                id="Perempuan"
                                name="jenisKelamin"
                                value="Perempuan"
                                <?php echo (isset($_POST['jenisKelamin']) && $_POST['jenisKelamin'] === 'Perempuan') ? 'checked' : ''; ?>
                                required
                            />
                            <label for="Perempuan"> Perempuan </label>
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="nik" class="font-semibold w-1/3 text-right pr-4"> 
                                Nomor Identitas 
                            </label>
                            <input
                                type="text"
                                id="nik"
                                name="nik"
                                maxlength="16"
                                minlength="16"
                                pattern="\d{16}"
                                class="border w-2/3"
                                value="<?php echo htmlspecialchars($_POST['nik'] ?? ''); ?>"
                                required
                            />
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="tipe_kamar" class="font-semibold w-1/3 text-right pr-4"> 
                                Tipe Kamar 
                            </label>
                            <select
                                id="tipe_kamar"
                                name="tipe_kamar"
                                class="border w-2/3"
                                required
                            >
                                <option value="">Pilih</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $selected = ($row["id"] == $tipeKamarId) ? 'selected' : '';
                                        echo '<option value="' . $row["id"] . '" ' . $selected . '>' . $row["tipe_kamar"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Tidak ada tipe kamar tersedia</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="harga" class="font-semibold w-1/3 text-right pr-4"> 
                                Harga
                            </label>
                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                class="border w-2/3"
                                value="<?php echo htmlspecialchars($harga); ?>"
                                readonly
                            />
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="tanggalPesan" class="font-semibold w-1/3 text-right pr-4">
                                Tanggal Pesan
                            </label>
                            <input 
                                type="date" 
                                id="tanggalPesan" 
                                name="tanggalPesan" 
                                class="border w-2/3"
                                min="<?php echo date('Y-m-d'); ?>"
                                value="<?php echo htmlspecialchars($_POST['tanggalPesan'] ?? ''); ?>"
                                required
                            />
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="durasiMenginap" class="font-semibold w-1/3 text-right pr-4">
                                Durasi Menginap
                            </label>
                            <input 
                                type="number" 
                                id="durasiMenginap" 
                                name="durasiMenginap" 
                                min="1"
                                step="1"
                                class="border"
                                value="<?php echo htmlspecialchars($durasiMenginap); ?>"
                                required
                            />
                            <p class="pl-2">Hari</p>
                        </div>
                        <div class="my-4 flex items-center">
                            <label for="termasukSarapan" class="font-semibold text-right pr-4">
                                Termasuk Sarapan
                            </label>
                            <input 
                                type="checkbox" 
                                id="termasukSarapan" 
                                name="termasukSarapan" 
                                <?php echo $termasukSarapan ? 'checked' : ''; ?>
                            />
                            <p class="pl-2">Ya</p>
                        </div>

                        <input
                            type="hidden"
                            id="diskon"
                            name="diskon"
                            value="<?php echo htmlspecialchars($diskon); ?>"
                        />
                        <div class="my-4 flex items-center">
                            <label for="totalHarga" class="font-semibold w-1/3 text-right pr-4"> 
                                Total Bayar
                            </label>
                            <input
                                type="number"
                                id="totalHarga"
                                name="totalHarga"
                                class="border w-2/3"
                                value="<?php echo htmlspecialchars($totalHarga); ?>"
                                readonly
                            />
                        </div>
                        <div class="my-8 flex justify-evenly gap-4">
                            <button
                                type="submit" name="hitung"
                                class="text-md px-4 rounded bg-blue-950 py-2 font-semibold text-white"
                            >
                                Hitung Total Bayar
                            </button>
                            <button
                                type="submit" name="submit"
                                class="text-md px-4 rounded bg-blue-950 py-2 font-semibold text-white"
                            >
                                Simpan
                            </button>
                            <button
                                type="reset" name="batal"
                                class="text-md px-4 rounded bg-blue-950 py-2 font-semibold text-white"
                            >
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php include '../layout/footer.php'; ?>
