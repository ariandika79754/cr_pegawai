<?php
$host = "localhost";
$user = "root"; // Ganti jika berbeda
$password = ""; // Ganti jika berbeda
$database = "pegawai_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
