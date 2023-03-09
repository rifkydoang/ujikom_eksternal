<?php
require '../koneksi.php';
require 'functions.php';

// cek apakah tombol yang ditekan adalah tambah
if (isset($_POST['tambah'])){
  // var_dump($_POST);
  // die;
  // cek apakah data berhasil ditambahkan atau tidak
  if(tambahFasilitas($_POST)) {
    echo
        "
        <script>alert('Data berhasil ditambahkan');
        document.location.href = 'fasilitas.php';
        </script>
        ";
  } else {
    echo
        "
        <script>alert('Data gagal ditambahkan');
        document.location.href = 'fasilitas.php';
        </script>
        ";
  }
}

// cek apakah tombol yang ditekan adalah edit
if (isset($_POST['edit'])){
  // var_dump($_POST);
  // die;
  // cek apakah data berhasil ditambahkan atau tidak
  if(editFasilitas($_POST)) {
    echo
        "
        <script>alert('Data berhasil diedit');
        document.location.href = 'fasilitas.php';
        </script>
        ";
  } else {
    echo
        "
        <script>alert('Data gagal diedit');
        document.location.href = 'fasilitas.php';
        </script>
        ";
  }
}

if (isset($_GET['id_fasilitas'])){
  
  if( hapusFasilitas($_GET['id_fasilitas']) ){
    echo "<script>
        alert('data berhasil di hapus');
        </script>";
  } else {
    "<script>
        alert('data gagal di hapus');
        </script>";
  }
}

session_start();
// cek apakah yang mengakses halaman ini sudah login
if(isset($_SESSION['level']) or $_SESSION['level'] == ""){
  if ($_SESSION['level'] == "2") {
    header("Location: ../resepsionis/pesanan.php");
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
  <title>Halaman Admin | Fasilitas</title>

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
        <a href="kamar.php" class="navbar-brand">
          <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Hotel Hebat</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="kamar.php" class="nav-link">Kamar</a>
            </li>
            <li class="nav-item">
              <a href="fasilitas.php" class="nav-link">Fasilitas</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="login-register d-flex">
      <?php
      if(isset($_SESSION['username']) && !empty($_SESSION['username']) )
      {?>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      <?php }?>
      </div>
    </nav>

   
    <!-- START TABEL FASILITAS -->
    <!-- Start Header -->
    <div class="content-wrapper bg-white">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Fasilitas</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- Ending Header -->

      <!-- Start Content -->
      <div class="content bg-white">
        <div class="container">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">Tambah</button>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Kamar</th>
                      <th>Nama Fasilitas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas");
                    while($fsk = mysqli_fetch_assoc($fasilitas)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                               <?php
                               $kamar = mysqli_query($koneksi, "SELECT * FROM kamar");
                               while ($kmr = mysqli_fetch_assoc($kamar)) {
                                if($fsk["id_kamar"] == $kmr["id_kamar"]){?>
                                    <?= $kmr['nama_kamar']?>
                                <?php
                                }
                               }
                               ?> 
                            </td>
                            <td><?= $fsk["nama_fasilitas"] ?></td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $fsk['id_fasilitas'] ?>">Edit</button>
                                <a class="btn btn-danger" href="fasilitas.php?id_fasilitas=<?= $fsk["id_fasilitas"] ?>" onclick="confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Ending Content -->
    <!-- ENDING TABEL FASILITAS -->


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>

    <!-- START MODAL TAMBAH -->
    <div class="modal fade" id="tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Fasilitas Kamar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group">
              <label>Nama Kamar</label>
              <select name="id_kamar" class="form-control">
                <option value="">--- Pilih Kamar ---</option>
                <?php
                include '../koneksi.php';
                $fasilitas = mysqli_query($koneksi, "SELECT * FROM kamar");
                while ($fsk = mysqli_fetch_array($fasilitas)) { 
                  ?>
                  <option value="<?php echo $fsk['id_kamar']; ?>"><?php echo $fsk['nama_kamar']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Fasilitas Kamar</label>
              <textarea name="fasilitas" class="form-control" rows="3"></textarea>
            </div>         
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- ENDING MODAL TAMBAH -->

    <!-- START MODAL EDIT -->
    <?php
    $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas");
    while($fsk = mysqli_fetch_assoc($fasilitas)) :
    ?>
    <div class="modal fade" id="edit<?= $fsk["id_fasilitas"] ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Fasilitas Kamar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="form-group">
                <input type="text" name="id_fasilitas" value="<?= $fsk['id_fasilitas']; ?>" hidden>
                <label>Nama Kamar</label>
                <select name="id_kamar" class="form-control">
                  <option value="">--- Pilih Kamar ---</option>
                  <?php
                  $kamar = mysqli_query($koneksi, "SELECT * FROM kamar");
                  while ( $kmr = mysqli_fetch_assoc($kamar) ) :
                    if ($kmr['id_kamar'] == $fsk['id_kamar']) {?>
                      <option value="<?= $kmr['id_kamar']; ?>" selected><?= $kmr['nama_kamar']; ?></option>
                    <?php } else { ?>
                      <option value="<?= $kmr['id_kamar']; ?>" ><?= $kmr['nama_kamar']; ?></option>
                    <?php 
                    }
                    endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Fasilitas Kamar</label>
                <textarea name="fasilitas" class="form-control" rows="3"><?= $fsk['nama_fasilitas'] ?></textarea>
              </div>         
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <!-- ENDING MODAL EDIT -->
  </body>
  </html>