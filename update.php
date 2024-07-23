<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJ">
    <title>Document</title>
</head>
<body>
   <div class="container"> 
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah data nilai yang dikirim menggunakan methos GET dengan nama id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]); // Perbaikan di sini

        $sql="select * from mahasiswa where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $npm=input($_POST["npm"]);
        $nama=input($_POST["nama"]);
        $alamat=input($_POST["alamat"]);
        $fakultas=input($_POST["fakultas"]);

        //Query update data pada tabel anggota 
        $sql="update mahasiswa set
        npm='$npm',
        nama='$nama',
        alamat='$alamat', // Perbaikan di sini
        fakultas='$fakultas' // Perbaikan di sini
        where id=$id";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($koneksi,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>"; // Perbaikan di sini
        }
    }

    ?>
    <h2>Update Data</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>npm:</label>
            <input type="text" name="npm" class="form-control" placeholder="Masukan npm" required />
</div>
<div class="form-group">
            <label>nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan nama" required />
</div>
<div class="form-group">
            <label>alamat:</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat" required ></textarea> <!-- Perbaikan di sini -->
</div>
<div class="form-group">
            <label>fakultas:</label>
            <input type="text" name="fakultas" class="form-control" placeholder="Masukan fakultas" required />
</div>

<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body> 
</html>