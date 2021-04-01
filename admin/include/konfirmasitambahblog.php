<?php
if(isset($_SESSION['id_user'])){
    $id_kategori_blog = $_POST['kategori_blog'];
    $id_user = $_SESSION['id_user'];
    $tanggal = date("Y-m-d");
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    echo $id_kategori_blog . $id_user . $tanggal . $judul . $isi;
    if (empty($id_kategori_blog)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=kategoriblog");
    } else if (empty($judul)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=judul");
    } else if (empty($isi)) {
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=sinopsis");
    } else {
        $sql = "INSERT INTO `blog` (`id_blog`, `id_kategori_blog`, `id_user`, `tanggal`, `judul`, `isi`) VALUES (NULL, '$id_kategori_blog', '$id_user', '$tanggal', '$judul', '$isi')";
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=blog&notif=tambahberhasil");
    }
}
