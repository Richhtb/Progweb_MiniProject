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
    <link rel="stylesheet" href="index.css">
    <script src="add.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- Tambahkan bagian HTML lainnya sesuai dengan kebutuhan -->
    <header>
        <h2>Halo <?php echo $_SESSION['nama'] ?></h2>
        <div class="buton">
            <button><a href="tambah.php">Tambah data</a></button>
            <button><a href="logout.php">Logout</a></button>
        </div>
    </header>

    <?php
    // Mendapatkan bulan dan tahun saat ini
    if (isset($_GET['month']) && isset($_GET['year'])) {
        $bulan_ini = $_GET['month'];
        $tahun_ini = $_GET['year'];
    } else {
        $bulan_ini = date('n');
        $tahun_ini = date('Y');
    }

    // Menghitung bulan sebelumnya dan tahun sebelumnya
    $bulan_sebelumnya = $bulan_ini - 1;
    $tahun_sebelumnya = $tahun_ini;
    if ($bulan_sebelumnya == 0) {
        $bulan_sebelumnya = 12;
        $tahun_sebelumnya--;
    }

    // Menghitung bulan selanjutnya dan tahun selanjutnya
    $bulan_selanjutnya = $bulan_ini + 1;
    $tahun_selanjutnya = $tahun_ini;
    if ($bulan_selanjutnya == 13) {
        $bulan_selanjutnya = 1;
        $tahun_selanjutnya++;
    }

    // Mendapatkan tanggal awal dan akhir bulan
    $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan_ini, $tahun_ini);
    $tanggal_awal = date('Y-m-01', strtotime($tahun_ini . '-' . $bulan_ini . '-01'));
    $tanggal_akhir = date('Y-m-t', strtotime($tahun_ini . '-' . $bulan_ini . '-01'));

    // Query untuk mendapatkan event berdasarkan tanggal
    // Query untuk mendapatkan event berdasarkan tanggal dan username
    $query = "SELECT id, nama_kegiatan, tgl_mulai, tgl_selesai FROM kegiatan WHERE tgl_mulai >= '$tanggal_awal' AND tgl_selesai <= '$tanggal_akhir' AND username = '".$_SESSION['username']."'";
    $result = mysqli_query($conn, $query);


    // Array untuk menyimpan event pada tanggal tertentu
    $events = array();

    // Mengisi array events dengan data dari database
    while ($row = mysqli_fetch_assoc($result)) {
        $tgl_mulai = date('d', strtotime($row['tgl_mulai']));
        $tgl_selesai = date('d', strtotime($row['tgl_selesai']));
        // for ($i = $tgl_mulai; $i <= $tgl_selesai; $i++) {
        //     $events[$i][] = array('id' => $row['id'], 'nama' => $row['nama_kegiatan']);
        // }
        for ($i = $tgl_mulai; $i <= $tgl_selesai; $i++) {
            $i = intval($i); // Mengubah string ke integer dan menghilangkan angka nol di awalnya
            if (!isset($events[$i])) {
                $events[$i] = array();
            }
            $events[$i][] = array('id' => $row['id'], 'names' => $row['nama_kegiatan']);
        }
    }?>

    <!-- // echo '<tr><th colspan="7">' . date('F Y', strtotime($tahun_ini . '-' . $bulan_ini . '-01')) . '</th></tr>'; -->
    <div class="navigate">
        <a href="?month=<?php echo $bulan_sebelumnya; ?>&year=<?php echo $tahun_sebelumnya; ?>">Previous</a>
        <span><?php echo date('F Y', strtotime($tahun_ini . '-' . $bulan_ini . '-01')); ?></span>
        <a href="?month=<?php echo $bulan_selanjutnya; ?>&year=<?php echo $tahun_selanjutnya; ?>">Next</a>
    </div>
    <?php

    // Membuat tabel kalender
    echo '<table>';
    // echo '<tr><th colspan="7">' . date('F Y', strtotime($tahun_ini . '-' . $bulan_ini . '-01')) . '</th></tr>';
    echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

    // Menentukan tanggal pertama dalam bulan
    $tanggal_pertama = date('N', strtotime($tahun_ini . '-' . $bulan_ini . '-01'));

    // Mengisi tabel dengan tanggal dan event
    echo '<tr>';
    for ($i = 1; $i < $tanggal_pertama; $i++) {
        echo '<td></td>';
    }
    for ($i = 1; $i <= $jumlah_hari; $i++) {
        echo '<td style="color: white; padding :5px;">';
        echo $i;
        if (isset($events[$i])) {
            echo '<ul>';
            foreach ($events[$i] as $event) {
                if(strlen($event['names']) >= 10){
                    echo '<li style="background-color: green; margin-bottom: 5px; cursor:pointer;"><a href="edit.php?id=' . $event['id'] . '" style="text-decoration:none;">' . substr($event['names'],0,9) . '...</a></li>';
                }
                else{
                    echo '<li style="background-color: green; margin-bottom: 5px; cursor:pointer;"><a href="edit.php?id=' . $event['id'] . '" style="text-decoration:none;">' . $event['names'] . '</a></li>';
                }
            }
            echo '</ul>';
        }
        echo '</td>';
        if (($tanggal_pertama + $i - 1) % 7 == 0) {
            echo '</tr><tr>';
        }
    }
    echo '</tr>';

    echo '</table>';
    ?>

</body>

</html>
