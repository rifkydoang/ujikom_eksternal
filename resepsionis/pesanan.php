<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if(isset($_SESSION['level']) or $_SESSION['level'] == ""){
  if ($_SESSION['level'] == "1") {
    header("Location: ../admin/kamar.php");
    die;
  }
  if ($_SESSION['level'] == "3") { 
    header("Location: ../index.php?pesan=gagal");
    die;
  } 
  if($_SESSION['level'] == ""){
    header("Location: ../index.php?pesan=gagal");
    die;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Resepsionis | Pesanan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a class="navbar-brand">
          <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Hotel Hebat</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="pesanan.php" class="nav-link">Data Pesanan</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="login-register">
      <?php
      if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {?>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      <?php } ?>
      </div>
    </nav>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Tamu</th>
                      <th>Tanggal Cek In</th>
                      <th>Tanggal Cek Out</th>
                      <th>Nama Kamar</th>
                      <th>Setatus</th>
                      <th>Aksi</th>
                      <th>Status Pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include '../koneksi.php';
                    $no = 1;
                    $data = mysqli_query($koneksi, "select * from pesanan");
                    while($d = mysqli_fetch_array($data)){
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nama_tamu']; ?></td>
                        <td><?php echo $d['cek_in']; ?></td>
                        <td><?php echo $d['cek_out']; ?></td>
                        <td>
                          <?php 
                          $kamar = mysqli_query($koneksi, "select * from kamar");
                          while ($a = mysqli_fetch_array($kamar)) {
                            if ($a['id_kamar'] == $d['id_kamar']) { ?>
                              <?php echo $a['nama_kamar']; ?>
                              <?php
                            }
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          if ($d['status'] == 1) { ?>
                            <span class="badge bg-warning">Belum di Konfirmasi</span>
                          <?php } else { ?>
                            <span class="badge bg-success">Sudah di Konfirmasi</span>
                          <?php } ?>
                        </td>
                        <td>
                          <form action="aksi_konfirmasi.php" method="POST">
                            <input type="text" name="id_pesanan" value="<?php echo $d['id_pesanan']; ?>" hidden>
                            <input type="text" name="status" value="2" hidden>
                            <button class="btn btn-sm btn-primary">Konfirmasi</button>
                          </form>
                        </td>   
                        <td>
                          <button class="btn btn-warning" data-toggle="modal" data-target="#lihat<?= $d['id_pesanan']?>">Lihat</button>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>

    <!-- Modal pembayaran -->
    <?php
    $pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan");
    while ($psn = mysqli_fetch_assoc($pesanan)) {
      $id_pesanan = $psn['id_pesanan'];
    ?>
    <div class="modal fade" id="lihat<?= $psn['id_pesanan'] ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data Kamar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
              <?php
              $bayar = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pemesan = '$id_pesanan'");
              while ($byr = mysqli_fetch_assoc($bayar)) {
              ?>
              <div class="form-group" hidden>
                <label>Kode transaki</label>
                <input type="text" class="form-control" name="nama_kamar" placeholder="Nama Kamar" value="<?= $byr['id_pemesan'] ?>" required>
              </div>
              <div class="form-group">
                <label>Foto Kamar</label>
                <img src="../bukti/<?= $byr['gambar'] ?>" alt="" width="400">
              </div>         
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?php
              }
            ?>
          </form>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
  </body>
  </html>