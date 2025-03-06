<?php
require 'db.php';

// Cek apakah ada keyword pencarian
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Ambil data pegawai berdasarkan keyword pencarian
$sql = "SELECT id, nama, status FROM pegawai";
if (!empty($keyword)) {
    $sql .= " WHERE nama LIKE '%$keyword%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <link href="css/css.css" rel="stylesheet">
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
            max-width: 800px;
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
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-add {
            text-decoration: none;
            color: #fff;
            background: #007BFF;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-add:hover {
            background: #0056b3;
        }
        .search-box {
            display: flex;
            align-items: center;
        }
        .search-box input {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-box button {
            margin-left: 8px;
            padding: 8px 15px;
            font-size: 14px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-box button:hover {
            background: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #f4f4f4;
            color: #555;
        }
        table tr:hover {
            background: #f1f1f1;
        }
        .btn-view {
            text-decoration: none;
            color: #fff;
            background: #4CAF50;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-view:hover {
            background: #45a049;
        }
        .status-active {
            color: #28a745;
            font-weight: bold;
        }
        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }
        .status-icon {
            cursor: pointer;
            font-size: 16px;
            color: #007BFF;
            margin-left: 8px;
        }
    </style>
    <script>
        function toggleStatus(id) {
            fetch(`update_status.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status');
                    }
                });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Daftar Pegawai</h1>
        <div class="table-header">
            <form class="search-box" method="GET" action="">
                <input type="text" name="search" placeholder="Cari nama..." value="<?php echo htmlspecialchars($keyword); ?>">
                <button type="submit">Search</button>
            </form>
            <a class="btn-add" href="add.php">Tambah</a>
        </div>
        <table>
            <tr>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['nama']; ?></td>
                    <td>
                        <?php if ($row['status'] == 1) { ?>
                            <span class="status-active">Aktif</span>
                        <?php } else { ?>
                            <span class="status-inactive">Tidak Aktif</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn-view" href="view.php?id=<?php echo $row['id']; ?>">View</a>
                        <span class="status-icon" onclick="toggleStatus(<?php echo $row['id']; ?>)">↻</span>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3">Tidak ada data ditemukan.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
