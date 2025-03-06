<?php
require 'db.php';

// Ambil ID pegawai
$id = $_GET['id'];
$sql = "SELECT * FROM pegawai WHERE id = $id";
$result = $conn->query($sql);
$pegawai = $result->fetch_assoc();

if (!$pegawai) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
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
            text-align: center;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3,
        p {
            margin: 10px 0;
        }

        h2 {
            font-size: 24px;
            color: #444;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Pegawai</h2>
        <img src="uploads/<?php echo $pegawai['foto']; ?>" alt="Foto Pegawai">
        <h1><?php echo $pegawai['nama']; ?></h1>
        <h3><?php echo $pegawai['jabatan']; ?></h3>
        <p>Email: <?php echo $pegawai['email']; ?></p>
        <p>Telepon: <?php echo $pegawai['telepon']; ?></p>
        <p>Alamat: <?php echo $pegawai['alamat']; ?></p>
        <a href="index.php">Kembali ke Daftar Pegawai</a>
    </div>
</body>

</html>
