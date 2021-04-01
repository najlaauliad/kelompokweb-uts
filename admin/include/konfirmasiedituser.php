<?php
if (isset($_SESSION['id_row_user'])) {
    $id_row_user = $_SESSION['id_row_user'];
    $nama =  $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    //get foto
    $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`='$id_row_user'";
    $query_f = mysqli_query($koneksi, $sql_f);
    while ($data_f = mysqli_fetch_row($query_f)) {
        $foto = $data_f[0];
        //echo $foto;
    }

    if (empty($nama)) {
        header("Location:index.php?include=edit-user&data=$id_row_user&notif=namakosong");
    } elseif (empty($email)) {
        header("Location:index.php?include=edit-user&data=$id_row_user&notif=emailkosong");
    } elseif (empty($username)) {
        header("Location:index.php?include=edit-user&data=$id_row_user&notif=usernamekosong");
    } else {
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $nama_file = $_FILES['foto']['name'];
        $direktori = 'foto/' . $nama_file;

        if (!empty($password)) {
            $password = md5($password);
            if (move_uploaded_file($lokasi_file, $direktori)) {
                if (!empty($foto)) {
                    unlink("foto/$foto");
                }
                $sql = "update `user` set `foto`='$nama_file', `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level' where `id_user`='$id_row_user'";
                mysqli_query($koneksi, $sql);
            } else {
                $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`='$password', `level`='$level' where `id_user`='$id_row_user'";
                mysqli_query($koneksi, $sql);
            }
        } else {
            if (move_uploaded_file($lokasi_file, $direktori)) {
                if (!empty($foto)) {
                    unlink("foto/$foto");
                }
                $sql = "update `user` set `foto`='$nama_file', `nama`='$nama', `email`='$email', `username`='$username', `level`='$level' where `id_user`='$id_row_user'";
                mysqli_query($koneksi, $sql);
            } else {
                $sql = "update `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level' where `id_user`='$id_row_user'";
                mysqli_query($koneksi, $sql);
            }
        }
        header("Location:index.php?include=user&notif=editberhasil");
    }
}
