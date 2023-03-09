<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body id="home" class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

    <!-- START NAVBAR -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="#home" class="navbar-brand">
          <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Hotel Hebat</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="kamar.php" class="nav-link">Kamar</a>
            </li>
            <li class="nav-item">
              <a href="#fasilitas" class="nav-link">Fasilitas</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="login-register d-flex">
      <?php session_start();
      if(isset($_SESSION['username']) && !empty($_SESSION['username']) )
      {?>
        <a class="btn btn-primary mr-3" href="profil.php">Profil</a>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      <?php }else{ ?>
          <a class="btn btn-primary mr-3" href="login.php">Login</a>
          <div class="garis"></div>
          <a class="btn btn-danger" href="register.php">Register</a>
      <?php } ?>
      </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- START CONTENT -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Hotel Hebat</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <div class="content">
        <div class="container">
          <div class="col-md-12">
            <?php 
            if(isset($_GET['pesan'])){
              if($_GET['pesan']=="gagal"){?>
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan !!!</h5>
                  Mohon maaf anda tidak bisa mengakses halaman ini
                </div>
              <?php }} ?>
            </div>
          </div>
        </div>
    <!-- END CONTENT -->

    <!-- MAIN CONTENT -->
    <div class="content">
          <div class="container">
            <div class="col-md-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="img/fotoHotel1.jpg" alt="First slide" height="450">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/fotoHotel2.jpeg" alt="Second slide" height="450">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/fotoHotel3.jpeg" alt="Third slide" height="450">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                      </span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <form action="proses_pesan.php" method="POST">
              <div class="col-md-12">
                <div class="card-body">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Tanggal Cek In</label>
                    <div class="col-sm-2">                  
                      <input type="date" name="cek_in" class="form-control" placeholder=".col-3" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Tanggal Cek Out</label>
                    <div class="col-sm-2">                  
                      <input type="date" name="cek_out" class="form-control" placeholder=".col-4" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Jumlah Kamar</label>
                    <div class="col-sm-1">                  
                      <input type="text" name="jml_kamar" class="form-control" placeholder="Jumlah Kamar" required>
                    </div>
                    <div class="col-sm-1">
                      <?php if(isset($_SESSION['username'])) {?>
                      <button type="button" class="form-control btn btn-primary" data-toggle="modal" data-target="#pesan">Pesan</button>
                      <?php } else{ ?>
                      <a type="button" class="form-control btn btn-primary" href="login.php">Pesan</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="pesan">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Form Pemesanan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php 
                    require 'koneksi.php';
                    ?>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" class="form-control" value="<?= $_SESSION['nama_user'] ?>" placeholder="Masukan Nama Pemesan" required>
                      </div>
                      <div class="form-group">
                        <label>Email Pemesan</label>
                        <input type="text" name="email_pemesan" class="form-control" value="<?= $_SESSION['email_user'] ?>" placeholder="Masukan Email Pemesan" required>
                      </div>
                      <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="text" name="no_handphone" class="form-control" value="0<?= $_SESSION['no_handphone'] ?>" placeholder="Masukan No. Handphone" required>
                      </div>
                      <div class="form-group">
                        <label>Nama Tamu</label>
                        <input type="text" name="nama_tamu" class="form-control" placeholder="Masukan Nama Tamu" required>
                      </div>
                      <div class="form-group">
                        <label>Nama Kamar</label>
                        <select name="id_kamar" class="form-control" required>
                          <option value="">--- Pilih Kamar ---</option>
                          <?php
                          include 'koneksi.php';
                          $data = mysqli_query($koneksi, "select * from kamar");
                          while ($d = mysqli_fetch_array($data)) { 
                            ?>
                            <option value="<?php echo $d['id_kamar']; ?>"><?php echo $d['nama_kamar']; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" name="pesan" class="btn btn-primary">Konfirmasi Pesanan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </form>
            <div class="card">
              <div class="col-md-12">
                <div class="card-body">
                  <h2 class="text-center">Tentang Kami</h2><br>
                  <p class="text-center">Selamat Datang di Hotel Kami Semoga Liburan Anda Menyenangkan Silahkan Untuk Memesan Kamar yang Anda Inginkan</p>
                </div>
              </div>
            </div>          
          </div><!-- /.container-fluid -->
        </div>
    <!-- END MAIN CONTENT -->

    
  
    <div id="fasilitas" class="container">
      <!-- START HEADER -->
      <div class="content-header center">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 style="display: inline-block;
    width: 1092px;" class="m-0 text-center">Fasilitas</h1>
            </div>
          </div>
        </div>
        <!-- ENDING HEADER -->
        <div class="col-md-12 d-flex ">
            <div class="card m-5" style="width: 18rem; ">
              <img src="img/kolamrenang.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text">Kolam Renang</p>
              </div>
            </div>
            <div class="card m-5" style="width: 18rem;">
              <img src="img/gym.jpeg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text">GYM</p>
              </div>
            </div>
            <div class="card m-5" style="width: 18rem;">
              <img src="img/playground.jpg " class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text">Playground Anak - anak</p>
              </div>
            </div>
        </div>
    </div>
<!-- START SCRIPT-->
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>