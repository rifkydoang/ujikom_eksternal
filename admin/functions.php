<?php
require 'koneksi.php';

// START KAMAR
// SELECT KAMAR
function tampil($query){
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];
    
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    
    return $rows;
}
// Tambah Kamar
function tambahKamar($data){
    global $koneksi;

    // ambil semua data dari form
    $nama_kamar = $data['nama_kamar'];
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $tambah = "INSERT INTO kamar
                VALUES
                ('','$nama_kamar',10,'$gambar')";

    mysqli_query($koneksi, $tambah);

    return mysqli_affected_rows($koneksi);
}

// Edit Kamar
function editKamar($data){
    global $koneksi;
    
    // ambi semua data dari form
    $id_kamar = $data['id_kamar'];
    $nama_kamar = $data['nama_kamar'];
    $gambarLama = $data['gambarLama'];

    if( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if ( !$gambar ) {
            return false;
        }
    }

    //query edit
    $edit = "UPDATE kamar 
            SET
            nama_kamar = '$nama_kamar',
            gambar = '$gambar'
            WHERE id_kamar = '$id_kamar'";

    mysqli_query($koneksi, $edit);

    return mysqli_affected_rows($koneksi);

}

// Hapus Kamar
function hapusKamar($id){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_kamar = $id");
    mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar = $id");

    return mysqli_affected_rows($koneksi);
}
// ENDING KAMAR



// START FASILITAS
// Tambah fasilitas
function tambahFasilitas($data){
    global $koneksi;

    //ambil semua data dari form
    $id_kamar = $data['id_kamar'];
    $fasilitas = $data['fasilitas'];

    $tambah = "INSERT INTO fasilitas
                VALUES
                ('','$id_kamar','$fasilitas')";
    mysqli_query($koneksi, $tambah);

    return(mysqli_affected_rows($koneksi));
}


// Edit Fasilitas
function editFasilitas($data){
    global $koneksi;

    //ambil semua data dari form
    $id_fasilitas = $data['id_fasilitas'];
    $id_kamar = $data['id_kamar'];
    $nama_fasilitas = $data['fasilitas'];

    $edit = "UPDATE fasilitas SET
            id_kamar = '$id_kamar',
            nama_fasilitas = '$nama_fasilitas'
            WHERE id_fasilitas = '$id_fasilitas'";

    mysqli_query($koneksi, $edit);

    return mysqli_affected_rows($koneksi);
}
// Ending Fasilitas

function hapusFasilitas($id){
    global $koneksi;

    // ambil data
    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_fasilitas = '$id'");

    return mysqli_affected_rows($koneksi);
}
// method upload gambar
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
    move_uploaded_file($tmpname, 'gambar/'.$namaGambarBaru);

    return $namaGambarBaru;
}

function updateJumlahKamar($jumlahKamarUser,$id){
    global $dataKamar;
    global $koneksi;
    $jumlahKamar = tampil("SELECT jumlah_kamar FROM kamar WHERE id_kamar = '$id'")[0]["jumlah_kamar"];

    if ($jumlahKamarUser > $jumlahKamar) {

        return false;
    } else {
        $total = $jumlahKamar - $jumlahKamarUser;
        mysqli_query($koneksi, "UPDATE kamar SET jumlah_kamar = $total WHERE id_kamar = '$id'");
        return true;
    }
}


?>