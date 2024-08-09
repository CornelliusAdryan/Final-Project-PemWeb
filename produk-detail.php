<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe's | Detail Produk </title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">

</head>
<body>
    <?php require "navbar.php"; ?>
    
    <!--detail produk-->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5">
                    <img src="image/<?php echo $produk['foto'] ?> " class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p>
                       <?php echo $produk['detail']; ?>
                    </p>
                    <p class="fs-3">
                       <?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5"><strong> <?php echo $produk['ketersediaan_stok']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- produk terkait -->
    <div class="container-fluid py-5 warna3">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-6 col-lg-3 mb-3 image-box">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?> ">
                        <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <?php require "footer.php";?>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>