<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil status saat ini
    $query = $conn->query("SELECT status FROM pegawai WHERE id = $id");
    if ($query->num_rows > 0) {
        $currentStatus = $query->fetch_assoc()['status'];
        $newStatus = $currentStatus == 1 ? 0 : 1;

        // Perbarui status
        $update = $conn->query("UPDATE pegawai SET status = $newStatus WHERE id = $id");

        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
