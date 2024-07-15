<?php
require 'function.php';
require 'cek.php';

if (isset($_GET['id'])) {
    $idpengeluaran = $_GET['id'];

    // Get the amount to be deleted
    $query = "SELECT jumlah FROM pengeluaran WHERE idpengeluaran = $idpengeluaran";
    $result = mysqli_query($conn, $query);
    $jumlah = mysqli_fetch_assoc($result)['jumlah'];

    // Update the total budget
    $totalanggaran_sekarang = getAnggaranTerbaru($conn);
    $totalanggaran_baru = $totalanggaran_sekarang + $jumlah;
    updateTotalAnggaran($conn, $totalanggaran_baru);

    // Delete the income entry
    $query = "DELETE FROM pengeluaran WHERE idpengeluaran = $idpengeluaran";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus');window.location.href='keluar.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');window.location.href='keluar.php';</script>";
    }

    $conn->close();
}
?>