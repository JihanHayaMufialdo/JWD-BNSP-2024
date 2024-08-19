<?php include '../layout/header.php'; ?>

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
                            required
                        />
                        <label for="Laki-Laki"> Laki-Laki </label>
                        <input
                            type="radio"
                            id="Perempuan"
                            name="jenisKelamin"
                            value="Perempuan"
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
                            required
                        />
                    </div>
                    <div class="my-4 flex items-center">
                        <label for="nik" class="font-semibold w-1/3 text-right pr-4"> 
                            Tipe Kamar 
                        </label>
                        <select
                            id="nik"
                            name="nik"
                            class="border w-2/3"
                            required
                        >
                            <option value="">Pilih</option>
                            <option value="Standard">Standard</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Executive">Executive</option>
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
                            required
                        />
                        <p class="pl-2">Hari</p>
                    </div>
                    <div class="my-4 flex items-center">
                        <label for="durasiMenginap" class="font-semibold text-right pr-4">
                            Termasuk Sarapan
                        </label>
                        <input 
                            type="checkbox" 
                            id="durasiMenginap" 
                            name="durasiMenginap" 
                            class="border"
                        />
                        <p class="pl-2">Ya</p>
                    </div>
                    <div class="my-4 flex items-center">
                        <label for="totalBayar" class="font-semibold w-1/3 text-right pr-4"> 
                            Total Bayar
                        </label>
                        <input
                            type="number"
                            id="totalBayar"
                            name="totalBayar"
                            class="border w-2/3"
                            readonly
                        />
                    </div>
                    <div class="my-8 flex justify-evenly gap-4">
                        <button
                            type="button" name="hitung"
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