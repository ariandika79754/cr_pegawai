<?php
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Upload foto
    $foto = $_FILES['foto'];
    $targetDir = __DIR__ . "/uploads/";

    // Pastikan folder uploads/ tersedia
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fotoName = time() . "_" . basename($foto['name']);
    $targetFile = $targetDir . $fotoName;
    $fotoPath = "";

    if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
        $fotoPath = $fotoName; // Simpan nama file
    } else {
        $error = "Gagal mengupload file. Pastikan folder uploads/ memiliki izin tulis.";
    }

    if ($nama && $jabatan && $email && $telepon && $alamat && $fotoPath) {
        $sql = "INSERT INTO pegawai (nama, jabatan, email, telepon, alamat, foto) 
                VALUES ('$nama', '$jabatan', '$email', '$telepon', '$alamat', '$fotoPath')";
        if ($conn->query($sql)) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Gagal menambahkan data!";
        }
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pegawai</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #444;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input,
        textarea,
        select,
        button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Pegawai</h1>
        <?php if ($error) {
            echo "<p class='error'>$error</p>";
        } ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama" required>

            <select name="jabatan" required>
                <option value="" disabled selected>Pilih Jabatan</option>
                <option value="Manager">Manager</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Staf Administrasi">Staf Administrasi</option>
                <option value="Teknisi">Teknisi</option>
                <option value="Keuangan">Keuangan</option>
            </select>

            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telepon" placeholder="Telepon" required>
            <textarea name="alamat" rows="4" placeholder="Alamat" required></textarea>

            <!-- Input untuk Foto -->
            <input type="file" name="foto" accept="image/*" required>

            <button type="submit">Simpan</button>
        </form>
        <br>
        <a href="index.php">Kembali ke Daftar Pegawai</a>
    </div>
</body>

</html>