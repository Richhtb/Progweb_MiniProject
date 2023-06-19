<?php
include "db.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tambah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="add.js"></script>
    <title>Tambah</title>
    
</head>
<body>
    <header>
        <button><a href="index.php">Kembali<i class="fa fa-sign-out"></i></a></button>
        <h1>Form Kegiatan</h1>
        <button><a href="logout.php">Logout</a></button>
    </header>
    
    <form action="tambah.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nama">Nama Kegiatan</label></td>
                <td>
                    <input type="text" name="nama_kegiatan" required placeholder="Masukan nama Kegiatan" id="nama" >
                </td>

            </tr>
            <tr>
                <td><label for="mulai">Tanggal Mulai</label></td>
                <td><input type="date" name="tgl_mulai" required id="tgl_mulai" id="mulai" >
            </td>
            </tr>
            <tr>
                <td><label for="">Tanggal Selesai</label></td>
                <td><input type="date" name ="tgl_selesai" id="tgl_selesai" required >
            </td>
            </tr>
            <tr>
                <td><label for="levels">Level</label></td>
                <td>
                    <select name="level" id="levels">
                        <option value="Sangat Penting" selected>Sangat Penting</option>
                        <option value="Penting">Penting</option>
                        <option value="Biasa">Biasa</option>
                    </select>

                </td>
            </tr>
            <tr>
                <td><label>Durasi</label></td>
                <td>
                    <input type="number" name="jam"  min="0"  id="jam" required class="hour">
                    <label for="jam">Jam</label>
                    
                    <input type="number" name="menit" max="59" min="0"  id="menit" required class="minute">
                    <label for="menit">Menit</label>
                </td>
            </tr>
            <tr>
                <td><label for="tempat">Lokasi</label></td>
                <td><input type="text" name="lokasi"  placeholder="Masukan lokasi" required id="tempat"></td>
            </tr>

            <tr>
                <td><label for="gambar" id="picture">Gambar</label></td>
                <td><input type="file" name="gambar" id="gambar"></td>
            </tr>

            <tr class="tombol">
                <td colspan="2">
                    <button type="submit" name="submit">Kirim</button>
                    <button type="reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>
    <p id="textmessage"></p>


    <?php
        if(isset($_POST["submit"])){
            $nama = $_POST["nama_kegiatan"];
				$mulai = $_POST["tgl_mulai"];
				$selesai = $_POST["tgl_selesai"];
				$level = $_POST["level"];
                $jam = $_POST["jam"];
                $menit = $_POST["menit"];
                $lokasi = $_POST["lokasi"];
                $username = $_SESSION['username'];

                $uploadfile = "upload/".$_FILES["gambar"]["name"]; // tambah dari folder gambar ke $_FILE[gambar][name]
                $tipefile = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));

                
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $uploadfile)) {
                    // $sql = "INSERT INTO kegiatan (nama_kegiatan,tgl_mulai,tgl_selesai,level, jam, menit,lokasi,gambar)VALUES ('$nama','$mulai','$selesai','$level','$jam','$menit','$lokasi','".$_FILES["gambar"]["name"]."')";
                    $sql = "INSERT INTO kegiatan (nama_kegiatan, tgl_mulai, tgl_selesai, level, jam, menit, lokasi, gambar, username) VALUES ('$nama', '$mulai', '$selesai', '$level', '$jam', '$menit', '$lokasi', '".$_FILES["gambar"]["name"]."', '$username')";
                    $res = mysqli_query($conn, $sql);
                    if($res){
                        echo '<script>setSuccessMessage();</script>';
                    }else{
                        echo '<script>setErrorMessage();</script>';
                    }
                }else {
                    // Tidak ada gambar yang diunggah, eksekusi query tanpa nama gambar
                    $sql = "INSERT INTO kegiatan (nama_kegiatan, tgl_mulai, tgl_selesai, level, jam, menit, lokasi, username) VALUES ('$nama', '$mulai', '$selesai', '$level', '$jam', '$menit', '$lokasi', '$username')";
                    $res = mysqli_query($conn, $sql);
                    if($res){
                        echo '<script>setSuccessMessage();</script>';
                    }else{
                        echo '<script>setErrorMessage();</script>';
                    }
                }
			}
    ?>

    </body>
</html>