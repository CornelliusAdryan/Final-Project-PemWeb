<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "shoe's";

require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("DATABASE IS NOT FOUND");
}
$kategori       = "";
$nama       = "";
$alamat     = "";
$produk   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from transaksi where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "BERHASIL MELAKUKAN DELETE DATA";
    }else{
        $error  = "GAGAL MELAKUKAN DELETE DATA";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "SELECT * FROM transaksi WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $kategori        = $r1['kategori'];
    $nama       = $r1['nama'];
    $alamat     = $r1['alamat'];
    $produk   = $r1['produk'];

    if ($kategori == '') {
        $error = "DATA IS NOT FOUND";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $kategori        = $_POST['kategori'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $produk   = $_POST['produk'];

    if ($kategori && $nama && $alamat && $produk) {
        if ($op == 'edit') { //untuk update
            $sql1       = "UPDATE transaksi set kategori = '$kategori',nama='$nama',alamat = '$alamat',produk='$produk' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "BERHASIL MELAKUKAN UPDATE DATA";
            } else {
                $error  = "GAGAL MELAKUKAN UPDATE DATA";
            }
        } else { //untuk insert
            $sql1   = "INSERT INTO transaksi(kategori,nama,alamat,produk) values ('$kategori','$nama','$alamat','$produk')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "BERHASIL UPDATE DATA";
            } else {
                $error      = "GAGAL UPDATE DATA";
            }
        }
    } else {
        $error = "SILAHKAN LENGKAPI DATA";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe's | Pemesanan Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                PEMESAN PRODUK SHOE'S
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Produk Shoe's</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from transaksi order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $kategori      = $r2['kategori'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $produk   = $r2['produk'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kategori ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $produk ?></td>
                                <td scope="row">
                                    <a href="form.php?op=edit&id=<?php echo $id ?>"onclick="return confirm('APAKAH YAKIN AKAN MELAKUKAN EDIT DATA ?')"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="form.php?op=delete&id=<?php echo $id?>" onclick="return confirm('APAKAH YAKIN AKAN MELAKUKAN DELETE DATA ?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
        <div class="col-12">
        <a href="index.php" class="tombol">KEMBALI</a>
        </div>
    </div>
</body>

</html>