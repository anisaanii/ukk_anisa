<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$user_id = $_SESSION['id'];

$ceksuka = mysqli_query($koneksi, "SELECT * FROM  like_foto WHERE foto_id='$id' AND user_id='
$user_id'");
// var_dump(mysqli_num_rows($ceksuka));
if (mysqli_num_rows($ceksuka) == 1){
    // while($row = mysqli_fetch_array($ceksuka)){
        // $likeid = $row['likeid'];
        $query = mysqli_query($koneksi, "DELETE FROM like_foto WHERE foto_id='$id' AND user_id='$user_id'");
        // var_dump($koneksi);
        echo "<script>
        location.href='../admin/home.php';
        </script>";
    // }
}else{
    $tanggal_like = date('Y-m-d');
    $query = mysqli_query($koneksi,"INSERT INTO like_foto VALUES('','$id','$user_id','$tanggal_like')");
    echo "<script>
    location.href='../admin/home.php';
    </script>";

}

{ }
?>