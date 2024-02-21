<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password'");

$cek = mysqli_num_rows($sql);


if ($cek > 0) {
    $data = mysqli_fetch_array($sql);

    $_SESSION['email'] = $data['email'];
    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = 'login';
    echo "<script>
    alert('login berhasil');
    location.href='../admin/index.php';

    </script>";
}else {
        echo "<script>
        alert('email atau password salah!');
        location.href='../login.php';
    
        </script>";
    }


?>