<?php
require 'function.php';
require 'cek.php';

$id = $_GET['id'];
$sql = "DELETE FROM anggaran WHERE idanggaran = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil dihapus');window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus');window.location.href='index.php';</script>";
};

?>
