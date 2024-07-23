<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Website safa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">SAFA ATUL UMMAH</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR DATA MAHASISWA</center></h4>
        <?php
        include "koneksi.php";

        //Cek apakah ada kiriman form dari method get
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET["id"]);
            $sql = "DELETE FROM mahasiswa WHERE id='$id'";
            $hasil = mysqli_query($koneksi, $sql);

            //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>npm</th>
                    <th>nama</th>
                    <th>alamat</th>
                    <th>fakultas</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
                $hasil = mysqli_query($koneksi, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data["npm"]; ?></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["alamat"]; ?></td>
                    <td><?php echo $data["fakultas"]; ?></td>
                    <td>
                        <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
        <a href="logout.php" class="btn btn-primary" role="button">Logout</a>

    </div>
</body>
</html>