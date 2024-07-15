<?php
require 'function.php';
require 'cek.php';

if(isset($_POST['editanggaran'])){
    $id = $_POST['idanggaran'];
    $tanggal = $_POST['tanggal'];
    $totalanggaran = $_POST['totalanggaran'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE anggaran SET tanggal='$tanggal', totalanggaran='$totalanggaran', keterangan='$keterangan' WHERE idanggaran='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error memperbarui data: " . $conn->error;
    }

    $conn->close();
    header('Location: index.php');
    exit();
}
?>
