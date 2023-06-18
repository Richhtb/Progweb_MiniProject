<?php
    include "db.php";

    session_start();
    if (!isset($_SESSION['username'])){
        header("location: login.php");
    }

    $id = null;
    if($_GET){
    $id = $_GET["id"];
    $sql = "SELECT * FROM kegiatan WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $oldName = $row["nama_kegiatan"];
        $oldmulai = $row["tgl_mulai"];
        $oldselesai = $row["tgl_selesai"];
        $oldlevel = $row["level"];
        $oldjam = $row["jam"];
        $oldmenit = $row["menit"];
        $oldlokasi = $row["lokasi"];
        $oldgambar = $row["gambar"];
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <script src="edit.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Edit</title>
</head>
<body>
    <header>
        <button><a href="index.php">Kembali<i class="fa fa-sign-out"></i></a></button>
        <h1>Form Kegiatan</h1>
        <button><a href="logout.php">Logout</a></button>
    </header>
    <form action="edit.php" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm()">
        <input type="hidden" name="id" value=<?php if($id != null){echo $id;}?>>
            <table>
                <tr>
                    <td><label for="nama">Nama Kegiatan</label></td>
                    <td>
                        <input type="text" name="nama_kegiatan"  required placeholder="Masukan nama Kegiatan" id="nama" value="<?php if($id != null){echo "".$oldName."";} else{echo "";} ?>">
                    </td>

                </tr>
                <tr>
                    <td><label for="mulai">Tanggal Mulai</label></td>
                    <td><input type="date" name="tgl_mulai" required id="tgl_mulai" id="mulai" value="<?php if($id != null){echo "".$oldmulai."";} else{echo "";} ?>">
                </td>
                </tr>
                <tr>
                    <td><label for="">Tanggal Selesai</label></td>
                    <td><input type="date" name ="tgl_selesai" id="tgl_selesai" required value="<?php if($id != null){echo "".$oldselesai."";} else{echo "";} ?>"></td>
                </tr>
                <tr>
                    <td><label for="levels">Level</label></td>
                    <td>
                        <select name="level" id="levels">
                            <option value="Sangat Penting" <?php if(isset($oldlevel) && $oldlevel == 'Sangat Penting') echo 'selected'?> selected>Sangat Penting</option>
                            <option value="Penting" <?php if(isset($oldlevel) && $oldlevel == 'Penting') echo 'selected'?>>Penting</option>
                            <option value="Biasa" <?php if(isset($oldlevel) && $oldlevel == 'Biasa') echo 'selected'?>>Biasa</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Durasi</label></td>
                    <td>
                        <input type="number" name="jam"  min="0"  id="jam" required class="hour" value="<?php if($id != null){echo "".$oldjam."";} else{echo "";} ?>">
                        <label for="jam">Jam</label>
                        
                        <input type="number" name="menit" max="59" min="0"  id="menit" required class="minute"  value="<?php if($id != null){echo "".$oldmenit."";} else{echo "";} ?>">
                        <label for="menit">Menit</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="tempat">Lokasi</label></td>
                    <td><input type="text" name="lokasi"  placeholder="Masukan lokasi" required id="tempat" value="<?php if($id != null){echo "".$oldlokasi."";} else{echo "";} ?>"></td>
                </tr>

                <tr>
                    <td><label for="gambar">Gambar</label></td>
                    <td>
                        <input type="hidden" name="img" value="<?php echo $oldgambar?>">
                        <input type="file" name="gambar" id="gambar">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="upload/<?php echo $oldgambar ?>"  height="100px"></td>
                </tr>

                <tr class="tombol">
                    <td colspan="2">
                        <button type="submit" name="submit" id="submitBtn" class="button">
                            <div class="button1">
                                <i class="fa fa-edit"></i>
                                <!-- <img src="delete.png" alt=""> -->
                                Edit
                            </div>
                        </button>

                        <button id="deleteBtn" class="btn">
                            <div class="button2">
                                <i class="fa fa-trash-o"></i>
                                    <!-- <img src="delete (1).png" alt="" width="10px" height="10px"> -->
                                <a href="hapus.php?id=<?php echo $id; ?>" id = "deleteLink">Hapus</a>
                            </div>
                        </button>
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
        
            if($_FILES["gambar"]["name"] != ""){
                move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/".$_FILES["gambar"]["name"]);
                // $sql = "UPDATE kegiatan SET nama_kegiatan='".$nama."', gambar='".$_FILES["gambar"]["name"]."', tgl_mulai='".$mulai."', tgl_selesai='".$selesai."', level='".$level."', jam='".$jam."', menit ='".$menit."', lokasi='".$lokasi."' WHERE username='".$username."'";
                $sql = "UPDATE kegiatan SET nama_kegiatan='".$nama."', gambar='".$_FILES["gambar"]["name"]."', tgl_mulai='".$mulai."', tgl_selesai='".$selesai."', level='".$level."', jam='".$jam."', menit='".$menit."', lokasi='".$lokasi."' WHERE username='".$_SESSION['username']."' AND id='".$_POST['id']."'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>setSuccessMessage();</script>";
                }else{
                    echo "<script>setErrorMessage();</script>";
                }
            }else{
                // $sql = "UPDATE kegiatan SET nama_kegiatan='".$nama."', tgl_mulai='".$mulai."', tgl_selesai='".$selesai."', level='".$level."', jam='".$jam."', lokasi='".$lokasi."' WHERE username='".$username."'";
                $sql = "UPDATE kegiatan SET nama_kegiatan='".$nama."', tgl_mulai='".$mulai."', tgl_selesai='".$selesai."', level='".$level."', jam='".$jam."',menit = '".$menit."', lokasi='".$lokasi."' WHERE username='".$_SESSION['username']."' AND id='".$_POST['id']."'";

                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>setSuccessMessage();</script>";
                }else{
                    echo "<script>setErrorMessage();</script>";
                }
            }
        }        
    ?>

    <script>
// window.onload = function() {
//   var tglSelesaiInput = document.getElementById("tgl_selesai");
//   var submitBtn = document.getElementById("submitBtn");
//   var deleteBtn = document.getElementById("deleteBtn");
//   var inputs = document.getElementsByTagName("input");
//   var selects = document.getElementsByTagName("select");
//   var deleteLink = document.getElementById("deleteLink");

//   tglSelesaiInput.addEventListener("change", function() {
//     var tglSelesai = new Date(this.value);
//     var today = new Date();
//     var yesterday = new Date(today);
//     yesterday.setDate(today.getDate() - 1);

//     if (tglSelesai <= yesterday) {
//       submitBtn.disabled = true;
//       deleteBtn.disabled = true;
//       disableInputs(inputs);
//       disableInputs(selects);
//     } else {
//       submitBtn.disabled = false;
//       deleteBtn.disabled = false;
//       enableInputs(inputs);
//       enableInputs(selects);
//     }
//   });

//   function disableInputs(elements) {
//     for (var i = 0; i < elements.length; i++) {
//       elements[i].disabled = true;
//     }
//   }

//   function enableInputs(elements) {
//     for (var i = 0; i < elements.length; i++) {
//       elements[i].disabled = false;
//     }
//   }

//   // Disable inputs if the selected date is earlier than yesterday on page load
//   var tglSelesai = new Date(tglSelesaiInput.value);
//   var today = new Date();
//   var yesterday = new Date(today);
//   yesterday.setDate(today.getDate() - 1);

//   if (tglSelesai <= yesterday) {
//     submitBtn.disabled = true;
//     deleteBtn.disabled = true;
//     disableInputs(inputs);
//     disableInputs(selects);
//   }
// };
window.onload = function() {
  var tglSelesaiInput = document.getElementById("tgl_selesai");
  var submitBtn = document.getElementById("submitBtn");
  var deleteBtn = document.getElementById("deleteBtn");
  var inputs = document.getElementsByTagName("input");
  var selects = document.getElementsByTagName("select");
  var deleteLink = document.getElementById("deleteLink");

  tglSelesaiInput.addEventListener("change", function() {
    var tglSelesai = new Date(this.value);
    var today = new Date();
    var yesterday = new Date(today);
    yesterday.setDate(today.getDate() - 1);

    if (tglSelesai <= yesterday) {
      submitBtn.disabled = true;
      deleteBtn.disabled = true;
      disableInputs(inputs);
      disableInputs(selects);
      deleteLink.removeAttribute("href");
    } else {
      submitBtn.disabled = false;
      deleteBtn.disabled = false;
      enableInputs(inputs);
      enableInputs(selects);
      deleteLink.setAttribute("href", "hapus.php?id=<?php echo $id; ?>");
    }
  });

  function disableInputs(elements) {
    for (var i = 0; i < elements.length; i++) {
      elements[i].disabled = true;
    }
  }

  function enableInputs(elements) {
    for (var i = 0; i < elements.length; i++) {
      elements[i].disabled = false;
    }
  }

  var tglSelesai = new Date(tglSelesaiInput.value);
  var today = new Date();
  var yesterday = new Date(today);
  yesterday.setDate(today.getDate() - 1);

  if (tglSelesai <= yesterday) {
    submitBtn.disabled = true;
    deleteBtn.disabled = true;
    disableInputs(inputs);
    disableInputs(selects);
    deleteLink.removeAttribute("href");
  }
};

    </script>

</body>
</html>