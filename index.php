<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Keuangan Desa</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Desa Jatilawang</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Anggaran
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pendapatan
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pengeluaran
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>

                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Anggaran</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Anggaran
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>tanggal</th>
                                            <th>Total Anggaran</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * FROM anggaran";
                                        $result = $conn->query($sql);

                                        if($result->num_rows>0){
                                            $no = 1;
                                            while($row = $result->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>". $no."</td>";
                                            echo "<td>". $row["tanggal"]."</td>";
                                            echo "<td>". $row["totalanggaran"]."</td>";
                                            echo "<td>". $row["keterangan"]."</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' data-id='".$row['idanggaran']."' data-tanggal='".$row['tanggal']."' data-totalanggaran='".$row['totalanggaran']."' data-keterangan='".$row['keterangan']."'>Edit</button> ";
                                            echo "<a href='delete_anggaran.php?id=".$row['idanggaran']."' class='btn btn-danger'>Delete</a>";
                                            echo "</td>"; 
                                            echo"</tr>";
                                            $no++;
                                            }
    
                                        } else{
                                        echo "<tr><td colspan = '4'> Data tidak valid</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Anggaran</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <form method = "post">
                <input type= "date" name= "tanggal" placeholder ="tanggal" class = "form-control" required>
                <br>
                <input type= "number" name = "totalanggaran" placeholder = "totalanggaran" class = "form-control" required>
                <br>
                <input type= "text"   name = "keterangan" placeholder = "keterangan" class = "form-control" required>
                <br>
                <button type = "submit" class = "btn btn-primary" name = "addnewanggaran"> Submit </button> 
                </div>
                </form>

                <!-- Modal footer -->
                
             </div>
            </div>
            </div>
            <!-- The Edit Modal -->
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Anggaran</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <form method="post" action="edit_anggaran.php">
                        <input type="hidden" name="idanggaran" id="edit-idanggaran">
                        <input type="date" name="tanggal" id="edit-tanggal" placeholder="tanggal" class="form-control" required>
                        <br>
                        <input type="number" name="totalanggaran" id="edit-totalanggaran" placeholder="totalanggaran" class="form-control" required>
                        <br>
                        <input type="text" name="keterangan" id="edit-keterangan" placeholder="keterangan" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="editanggaran"> Submit </button> 
                    </form>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Tombol yang memicu modal
                var id = button.getAttribute('data-id');
                var tanggal = button.getAttribute('data-tanggal');
                var totalanggaran = button.getAttribute('data-totalanggaran');
                var keterangan = button.getAttribute('data-keterangan');

                // Update isi modal.
                var modalBodyInputId = editModal.querySelector('#edit-idanggaran');
                var modalBodyInputTanggal = editModal.querySelector('#edit-tanggal');
                var modalBodyInputTotalAnggaran = editModal.querySelector('#edit-totalanggaran');
                var modalBodyInputKeterangan = editModal.querySelector('#edit-keterangan');

                modalBodyInputId.value = id;
                modalBodyInputTanggal.value = tanggal;
                modalBodyInputTotalAnggaran.value = totalanggaran;
                modalBodyInputKeterangan.value = keterangan;
            });
        });
        </script>
    </body>
</html>