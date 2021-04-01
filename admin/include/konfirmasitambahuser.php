<?php
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
$nama_file = $_FILES['foto']['name'];
if (empty($nama_file)) {
    header("Location:index.php?include=tambah-user&notif=fotokosong");
} elseif (empty($nama)) {
    header("Location:index.php?include=tambah-user&notif=namakosong");
} elseif (empty($email)) {
    header("Location:index.php?include=tambah-user&notif=emailkosong");
} elseif (empty($username)) {
    header("Location:index.php?include=tambah-user&notif=usernamekosong");
} elseif (empty($password)) {
    header("Location:index.php?include=tambah-user&notif=passwordkosong");
} else {
    //files
    $lokasi_file = $_FILES['foto']['tmp_name'];  
    $direktori = 'foto/' . $nama_file;
    move_uploaded_file($lokasi_file, $direktori);

    //password
    $password = md5($password);

    $sql = "insert into `user` (`id_user`, `nama`, `email`, `username`, `password`, `level`, `foto`)
values (NULL, '$nama', '$email', '$username', '$password', '$level', '$nama_file')";
    mysqli_query($koneksi, $sql);
    header("Location:index.php?include=user&notif=tambahberhasil");
}
