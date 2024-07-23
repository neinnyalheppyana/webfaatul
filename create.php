<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container"> <!-- Perbaikan typo pada 'class' -->
    <?php
    //Include file koneksi,untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {

        $npm=input($_POST["npm"]);
        $nama=input($_POST["nama"]);
        $alamat=input($_POST["alamat"]);
        $fakultas=input($_POST["fakultas"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into mahasiswa (npm,nama,alamat,fakultas) values
        ('$npm','$nama','$alamat','$fakultas')"; // Perbaikan variabel PHP

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($koneksi,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data</h2>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"> <!-- Perbaikan tanda kutip -->
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
            <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat" required />
        </div>
        <div class="form-group">
            <label>fakultas:</label>
            <input type="text" name="fakultas" class="form-control" placeholder="Masukan fakultas" required />
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>
</html>