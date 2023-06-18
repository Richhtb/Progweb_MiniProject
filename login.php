<?php
 include "db.php";

 session_start();
    if (isset($_SESSION['username'])) {
        header("location: index.php");
        exit();
    }


    if (isset($_POST["login"])) {
        $user = $_POST['username'];
        $pass = $_POST["password"];

        $ambil = mysqli_query($conn, "SELECT * FROM mhs WHERE username = '$user' AND password ='$pass'");

        if (mysqli_num_rows($ambil) === 1) {
            $usern = mysqli_fetch_array($ambil)['nama'];
            $_SESSION["nama"] = $usern;
            $_SESSION['username'] = $user;
            header('location: index.php');
            exit();
        } else {
            echo "<script>alert('username atau password salah');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>

</head>
<body>
    <div id="bg">
        <video autoplay loop muted>
            <source src="NIGHT CITY_BUILDING VIEW VIDEO PRESENTATION_ENTERTAINMENT.mp4">
        </video>
    </div>

    <div class = "card">
        <div class="form">
            <form action="" method ="POST">
            <img src="kunci.png" alt="" width="50px">
            <h1>Login</h1>
                <div>
                    <label for="user">Username</label>
                    <input type="text" name ="username" placeholder="Masukan Username" id="user">
                </div>
                <br>
                <div>
                    <label for="pass">Password</label>
                    <input type="password" name="password"  placeholder="Masukan Password" id="pass">
                </div>
                <br>
                    <input type="submit" value = "login" name="login" class = "login">
            </form>
        </div>
    </div>
</body>
</html>