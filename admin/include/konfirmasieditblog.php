<?php
if (isset($_SESSION['id_blog'])) {
    $id_blog = $_SESSION['id_blog'];
    $id_kategori_blog = $_POST['kategori_blog'];
    $judul = $_POST['judul'];
    $isi = strip_tags(addslashes($_POST['isi']));

    if (empty($id_kategori_blog)) {
        header("Location:index.php?include=edit-blog&data=$id_blog&notif=editkosong&jenis=kategoriblog");
    } else if (empty($judul)) {
        header("Location:index.php?include=edit-blog&data=$id_blog&notif=editkosong&jenis=judul");
    } else if (empty($isi)) {
        header("Location:index.php?include=edit-blog&data=$id_blog&notif=editkosong&jenis=sinopsis");
    } else {
        $sql = "UPDATE `blog` set `id_kategori_blog`='$id_kategori_blog',`judul`='$judul',`isi`='$isi' WHERE `id_blog`='$id_blog'";
        mysqli_query($koneksi, $sql);
        header("Location:index.php?include=blog&notif=editberhasil");
    }
}
