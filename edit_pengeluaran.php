<?php
require 'function.php';
require 'cek.php';

if(isset($_POST['editpengeluaran'])){
    $idpengeluaran = $_POST['idpengeluaran'];
    $tanggal = $_POST['tanggal'];
    $jumlah_baru = $_POST['jumlah'];
    $tujuan = $_POST['tujuan'];
    $keterangan = $_POST['keterangan'];

    // Get the old amount
    $query = "SELECT jumlah FROM pengeluaran WHERE idpengeluaran = $idpengeluaran";
    $result = mysqli_query($conn, $query);
    $jumlah_lama = mysqli_fetch_assoc($result)['jumlah'];

    // Update the total budget
    $totalanggaran_sekarang = getAnggaranTerbaru($conn);
    $totalanggaran_baru = $totalanggaran_sekarang + $jumlah_lama - $jumlah_baru;
    updateTotalAnggaran($conn, $totalanggaran_baru);

    // Update the expense entry
    $query = "UPDATE pengeluaran SET tanggal = ?, jumlah = ?, tujuan = ?, keterangan = ? WHERE idpengeluaran = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $tanggal, $jumlah_baru, $tujuan, $keterangan, $idpengeluaran);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate');window.location.href='keluar.php';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate');window.location.href='keluar.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
