<?php
require 'koneksi.php';

if (isset($_POST['bayar'])) {

    $id_pesanan = $_POST['id_pesanan'];
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $tambah = "INSERT INTO transaksi
                VALUES
                ('','$id_pesanan','$gambar')";

    mysqli_query($koneksi, $tambah);

    if (mysqli_affected_rows($koneksi)) {
        echo
        "
        <script>alert('upload data pembayaran berhasil);
        document.location.href = 'profil.php';
        </script>
        ";
        header("Location: profil.php");
    } else {
        echo
        "
        <script>alert('upload data pembayaran gagal');
        document.location.href = 'profil.php';
        </script>
        ";
    }
}


function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //cek apakah gambar diupload atau tidak
    if ( $error === 4 ) {
        echo "<script>
        alert('Anda belum memasukkan gambar, silahkan masukkan gambar');
        </script>";
        return false;
    }

    // cek apakah tipe gambar sesuai
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".",$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "<script>
        alert('Tipe gambar tidak sesuai');
        </script>";
        return false;
    }

    // cek apakah ukuran gambar tidak terlalu besar
    if( $ukuranFile > 10000000 ){
        echo "<script>
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    // memberi nama baru pada gambar
    $namaGambarBaru = uniqid();
    $namaGambarBaru .= ".";
    $namaGambarBaru .= $ekstensiGambar;

    // lolos pengecekan gambar siap diupload
    move_uploaded_file($tmpname, 'bukti/'.$namaGambarBaru);

    return $namaGambarBaru;
}
?>