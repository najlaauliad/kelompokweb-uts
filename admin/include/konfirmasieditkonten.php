<?php
if (isset($_SESSION['id_konten'])) {
    $id_konten = $_SESSION['id_konten'];
    $judul = $_POST['judul'];
    $isi = $_POST['sinopsis'];
    $date = date("Y-m-d");

    if (empty($judul)) {
        header("Location:index.php?include=edit-konten&data=$id_konten&notif=editkosong&jenis=judul");
    } else if (empty($isi)) {
        header("Location:index.php?include=edit-konten&data=$id_konten&notif=editkosong&jenis=sinopsis");
    } else {
        $sql = "UPDATE `konten` set `judul`='$judul', `isi`='$isi', `tanggal`='$date' WHERE `id_konten`='$id_konten'";
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=konten&notif=editberhasil");
    }
}
