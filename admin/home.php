<?php
session_start();
$user_id = $_SESSION['id'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('anda belum login');
    location.href='../index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME TO GALERI FOTO</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/> 
</head>
<body>
    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">GALERI FOTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a href="home.php" class="nav-link">home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">foto</a>
                </div>

                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        album :
        <?php
        $album = mysqli_query($koneksi, "SELECT * FROM album WHERE user_id='$user_id'");
        while($row = mysqli_fetch_array($album)){?>
        <a href="home.php?albumid=<?php echo $row['id'] ?>" class="btn btn-primary"><?php echo $row['nama_album']?></a>

        <?php }?>
        
        <div class="row">
        <?php
        if (isset($_GET['albumid'])){
            $albumid = $_GET['albumid'];
            $query = mysqli_query($koneksi, "SELECT * FROM  foto WHERE user_id='$user_id' AND album_id='
            $albumid'");
            while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3 mt-2">
                <div class="card">
                     <img style="height: 12 rem;" src="../assets/img/<?php echo $data['lokasi_file']?>" 
                     class="card-img-top" title="<?php echo $data['judul_foto']?>" 
                     class="card-footer text-center">
                </div>
                <div class="card-footer">
                <!-- <a href="../config/proses_like.php?id=<?php echo $data ?>['id']?> type"
                submit name="suka"><i class="fa-regular fa-heart"></i></a> -->
                <?php
                $foto_id = $data['id'];
                
                $ceksuka = mysqli_query($koneksi, "SELECT * FROM  like_foto WHERE foto_id='$foto_id' AND user_id='$user_id'");
                if (mysqli_num_rows($ceksuka) == 1){ ?>
            
                   <a href="../config/proses_like.php?id=<?php echo $data['id']?>" 
                   type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php }else{ ?>
                    <a href="../config/proses_like.php?id=<?php echo $data['id']?>" 
                    type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                    <?php }
                $like =  mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$foto_id'");
        
                echo mysqli_num_rows($like). ' suka';
                // var_dump($like);

                ?>
                <a href=""><i class="fa-regular fa-comment"></i>3 komentar</a>
                </div>
                </div>
            </div>
        </div>
    </div>

           <?php } } else{
           }
        
    
    $query =  mysqli_query($koneksi, "SELECT * FROM foto WHERE user_id='$user_id'");
    while($data = mysqli_fetch_array($query)){
   ?>
                <div class="col-md-3 mt-2">
                <div class="card">
                     <img style="height: 12 rem;" src="../assets/img/<?php echo $data['lokasi_file']?>" 
                     class="card-img-top" title="<?php echo $data['judul_foto']?>" 
                     class="card-footer text-center">
                </div>
                <div class="card-footer">
                <!-- <a href="../config/proses_like.php?id=<?php echo $data ?>['id']?> type"
                submit name="suka"><i class="fa-regular fa-heart"></i></a> -->
                <?php
                $foto_id = $data['id'];
                $ceksuka = mysqli_query($koneksi, "SELECT * FROM  like_foto WHERE foto_id='$foto_id' AND user_id='$user_id'");
                if (mysqli_num_rows($ceksuka) == 1){ ?>
                   <a href="../config/proses_like.php?id=<?php echo $data['id']?>" 
                   type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php }else{ ?>
                    <a href="../config/proses_like.php?id=<?php echo $data['id']?>" 
                    type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                    <?php }
                $like =  mysqli_query($koneksi, "SELECT * FROM like_foto WHERE foto_id='$foto_id'");
                echo mysqli_num_rows($like). 'suka';

                ?>
                <a href=""><i class="fa-regular fa-comment"></i>3 komentar</a>
                </div>
                </div>
            </div>
        </div>
    </div>

   <?php } ?>
   </div>
   </div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK 2024 | ANISA</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>