<?php 
include 'koneksi.php';
?>
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
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

    <!-- START NAVBAR -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="index.php" class="navbar-brand">
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
          </ul>
        </div>
      </div>
      <div class="login-register d-flex">
      <?php session_start();
      if(isset($_SESSION['username']) && !empty($_SESSION['username']) )
      {?>
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
      <!-- START HEADER -->
      <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Kamar</h1>
            </div>
          </div>
        </div>
        <!-- ENDING HEADER -->
        
        <!-- START MAIN CONTENT -->
        <div class="content">
        <div class="container">
          <?php
          $query = "SELECT * FROM kamar ORDER BY id_kamar ASC";
          $result = mysqli_query($koneksi, $query);
          if (!$result) {
            die("Query Error: ".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
          }

          $no = 1;

          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-12">
              <div class="card card-outline card-info">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card-body card-outline">
                        <table>
                          <tr>
                            <td><b>Nama Kamar :</b> <?php echo $row['nama_kamar']; ?></td>
                          </tr>
                          <tr>
                            <td> 
                              <b>Fasilitas :</b> <br>                             
                              <?php 
                              $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas");
                              while ($fsk = mysqli_fetch_array($fasilitas)) {
                                if ($fsk['id_kamar'] == $row['id_kamar']) { ?>
                                  <?php echo $fsk['nama_fasilitas']; ?>
                                  <?php
                                }
                              }
                              ?> 
                            </td>                                                      
                          </tr>
                          <tr>
                            <td><b>Jumlah Kamar: </b><?php
                            if($row['jumlah_kamar'] <= 0){
                              echo "Kamar tidak tersedia";
                            } else {
                              echo $row['jumlah_kamar'];
                            }
                            ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card-body card-outline">
                        <img class="d-block w-100" src="admin/gambar/<?php echo $row['gambar']; ?>" height="300">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php $no++; } ?>

          </div><!-- /.container-fluid -->
        </div>
        <!-- ENDING MAIN CONTENT -->
        <!-- ENDING CONTENT -->
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