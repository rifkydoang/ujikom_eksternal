<?php
// masukkan koneksi
require 'koneksi.php';

// cek apakah tombol sudah ditekan
if (isset($_POST["submit"])) {
    $nama_user = $_POST['nama'];
    $email_user = $_POST['email'];
    $no_handphone = $_POST['no_handphone'];
    $username = strtolower($_POST['username']);
    $password = mysqli_real_escape_string($koneksi,$_POST['password']);

    // var_dump($_POST);
    // die;
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    
    if(mysqli_fetch_row($cekUsername)){
      echo 
      "
        <script>alert('username tidak tersedia');
        document.location.href = 'register.php';
        </script>
        ";
      die;
    }

    $query_tambah = "INSERT INTO users VALUES ('','$nama_user','$email_user',$no_handphone,'$username','$password',3)";

    mysqli_query($koneksi, $query_tambah);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo
        "
        <script>alert('Anda berhasil Registrasi Akun');
        document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo
        "
        <script>alert('Anda gagal Registrasi Akun');
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Aplikasi Hotel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Registrasi</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Silahkan Regstrasi</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
          <div class="input-group mb-3">
            <input type="text" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="input-group mb-3">
            <input type="text" name="no_handphone" class="form-control" placeholder="Nomor Handphone">
          </div>
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>