<?php
require 'function.php';
require 'cek.php';

if (isset($_POST['editpendapatan'])) {
    $idpendapatan = $_POST['idpendapatan'];
    $tanggal = $_POST['tanggal'];
    $jumlah_baru = $_POST['jumlah'];
    $sumber = $_POST['sumber'];
    $keterangan = $_POST['keterangan'];

    // Get the old amount
    $query = "SELECT jumlah FROM pendapatan WHERE idpendapatan = $idpendapatan";
    $result = mysqli_query($conn, $query);
    $jumlah_lama = mysqli_fetch_assoc($result)['jumlah'];

    // Update the total budget
    $totalanggaran_sekarang = getAnggaranTerbaru($conn);
    $totalanggaran_baru = $totalanggaran_sekarang - $jumlah_lama + $jumlah_baru;
    updateTotalAnggaran($conn, $totalanggaran_baru);

    // Update the income entry
    $query = "UPDATE pendapatan SET tanggal = ?, jumlah = ?, sumber = ?, keterangan = ? WHERE idpendapatan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $tanggal, $jumlah_baru, $sumber, $keterangan, $idpendapatan);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate');window.location.href='masuk.php';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate');window.location.href='masuk.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
