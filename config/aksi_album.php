<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $namaalbum = $_POST['nama_album'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');
    $user_id = $_SESSION['id'];

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('','$namaalbum','$deskripsi','$tanggal
    ','$user_id')");
    echo "<script>
    alert('Data Berhasil Disimpan');
    location.href='../admin/album.php';
    </script>";

}

if (isset($_POST['edit'])) {
    $albumid = $_POST['id'];
    $nama_album = $_POST['nama_album'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal_dibuat = date('y-m-d');
    $id = $_SESSION['id'];

    $sql = mysqli_query($koneksi, "UPDATE album SET nama_album='$nama_album',deskripsi='$deskripsi',tanggal_dibuat='$tanggal_dibuat' WHERE id='$albumid'");

    echo "<script>
    alert('Data Berhasil Diperbarui');
    location.href='../admin/album.php';
    </script>";

}

if (isset($_POST['hapus'])) {
    $albumid = $_POST['id'];
    // var_dump($album_id);


    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE id='$albumid'");

    echo "<script>
    alert('Data Berhasil Dihapus!');
    location.href='../admin/album.php';
    </script>";

}

?>