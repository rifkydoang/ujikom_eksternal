<?php
require 'koneksi.php';
require 'admin/functions.php';

if ( isset($_POST['pesan']) ) {
    
    // var_dump($_POST);
    // die;
    //ambil data dari from
    $cek_in = $_POST['cek_in'];
    $cek_out = $_POST['cek_out'];
    $jumlah_kamar = $_POST['jml_kamar'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $email_pemesan = $_POST['email_pemesan'];
    $no_handphone = $_POST['no_handphone'];
    $nama_tamu = $_POST['nama_tamu'];
    $id_kamar = $_POST['id_kamar'];
    // var_dump($id_kamar);
    // die;

    //insert data
    $tambah = "INSERT INTO pesanan VALUES ('','$cek_in','$cek_out','$jumlah_kamar','$nama_pemesan','$email_pemesan','$no_handphone','$nama_tamu','$id_kamar','1')";

    $cekKamar = updateJumlahKamar($jumlah_kamar, $id_kamar);
    if (!$cekKamar) {
        echo
        "
        <script>alert('Jumlah kamar tidak tersedia');
        document.location.href = 'index.php';
        </script>
        ";
       die;
    }
    mysqli_query($koneksi, $tambah);

    if (mysqli_affected_rows($koneksi) > 0) {

        echo
        "
        <script>alert('Kamar berhasil dipesan');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>alert('Kamar gagal dipesan');
        document.location.href = 'index.php';
        </script>";
    }
}



?>