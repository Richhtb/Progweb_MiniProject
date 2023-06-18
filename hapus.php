<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

include "db.php";
$id = $_GET["id"];

// $id = $_GET["id"];
$sql = "DELETE FROM kegiatan WHERE id=$id";
if(mysqli_query($conn, $sql)){
    // echo "Data berhasil dihapus";
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
