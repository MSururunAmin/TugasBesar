<?php
session_start();
// membuat koneksi ke database

 $conn = mysqli_connect ("localhost","root","","keuangan");

 function getAnggaranTerbaru($conn) {
    $query = "SELECT totalanggaran FROM anggaran ";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['totalanggaran'];
    };
    return 0;
};

// Fungsi untuk memperbarui total anggaran
function updateTotalAnggaran($conn, $totalanggaran_baru) {
    $query = "UPDATE anggaran SET totalanggaran = '$totalanggaran_baru'";
    return mysqli_query($conn, $query);
};

 // menambah anggaran baru

 if(isset($_POST['addnewanggaran'])){
    $tanggal = $_POST['tanggal'];
    $totalanggaran = $_POST['totalanggaran'];
    $keterangan = $_POST['keterangan'];
    
    $addtotable = mysqli_query($conn, "insert into anggaran (tanggal,totalanggaran,keterangan) values('$tanggal','$totalanggaran','$keterangan')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo "gagal";
        header('location:index.php');
    };
 };

 //menambah uang masuk
 if(isset($_POST['addnewpemasukan'])){
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $sumber = $_POST ['sumber'];
    $keterangan = $_POST['keterangan'];
    
    $addtomasuk = mysqli_query($conn, "insert into pendapatan (tanggal,jumlah,sumber,keterangan) values('$tanggal','$jumlah','$sumber','$keterangan')");
    if ($addtomasuk) {
        $totalanggaran_sekarang = getAnggaranTerbaru($conn);
        $totalanggaran_baru = $totalanggaran_sekarang + $jumlah;
        if (updateTotalAnggaran($conn, $totalanggaran_baru)) {
            header('Location: masuk.php');
        } else {
            echo "Gagal memperbarui total anggaran.";
        }
    } else {
        echo "Gagal menambah pemasukan.";
    }
}

 //menambah uang keluar
 
 if(isset($_POST['addnewpengeluaran'])){
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $tujuan = $_POST ['tujuan'];
    $keterangan = $_POST['keterangan'];
    $addtopengeluaran = mysqli_query($conn, "INSERT INTO pengeluaran (tanggal, jumlah, tujuan, keterangan) VALUES ('$tanggal', '$jumlah', '$tujuan', '$keterangan')");
    if ($addtopengeluaran) {
        $totalanggaran_sekarang = getAnggaranTerbaru($conn);
        $totalanggaran_baru = $totalanggaran_sekarang - $jumlah;
        if (updateTotalAnggaran($conn, $totalanggaran_baru)) {
            header('Location: keluar.php');
        } else {
            echo "Gagal memperbarui total anggaran.";
        }
    } else {
        echo "Gagal menambah pengeluaran.";
    }
 };


if(isset($_POST['updateanggaran'])) {
    $idanggaran = $_POST['idanggaran'];
    $tanggal = $_POST['tanggal'];
    $totalanggaran = $_POST['totalanggaran'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE anggaran SET tanggal = ?, totalanggaran = ?, keterangan = ? WHERE idanggaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $tanggal, $totalanggaran, $keterangan, $idanggaran);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate');window.location.href='index.php';</script>";
    }

    $stmt->close();
    $conn->close();
};



?>