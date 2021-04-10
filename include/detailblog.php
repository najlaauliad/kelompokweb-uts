<?php
if (isset($_GET['data'])) {
  $id_blog = $_GET['data'];
} 

if(empty($_GET['data'])){
  header("Location:index.php");
}
?>

<section id="blog-header">
  <div class="container">
    <h1 class="text-white">BLOG</h1>
  </div>
</section><br><br>
<section id="blog-list">
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-9 blog-main">
        <div class="blog-post">
          <?php
          $sql = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user` WHERE `id_blog` LIKE '$id_blog'";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_row($query)) {
            $tanggal = $data[0];
            $judul = $data[1];
            $isi = $data[2];
            $kategori_blog = $data[3];
            $penulis = $data[4];
            $id_blog = $data[5];

            $pieces = explode("-", $tanggal);

          ?>

            <h2 class="blog-post-title"><?php echo $judul; ?></h2>
            <p class="blog-post-meta"><?php echo $pieces[2] . "-" . $pieces[1] . "-" . $pieces[0] ?> by <a href="#" style="pointer-events: none;"><?php echo $penulis; ?></a></p>

            <hr>
            <p><?php echo $isi; ?></p>
            <hr>
            <p><b>Kategori</b> : <a href="#" style="pointer-events: none;"><?php echo $kategori_blog; ?></a></p>
          <?php } ?>
        </div><br><br><!-- /.blog-post -->



      </div><!-- /.blog-main -->

      <aside class=" col-md-3 blog-sidebar">

        <div class="p-4">
          <h4 class="font-italic">Categories</h4>
          <ol class="list-unstyled mb-0">
            <?php
            $sql_t = "SELECT `id_kategori_blog`,`kategori_blog` FROM `kategori_blog` ORDER BY `kategori_blog`";
            $query_t = mysqli_query($koneksi, $sql_t);
            while ($data_t = mysqli_fetch_row($query_t)) {
              $id_kat = $data_t[0];
              $nama_kat = $data_t[1];
            ?>
              <li><a href="index.php?include=blog&data=<?php echo $id_kat; ?>">
                  <?php echo $nama_kat; ?></a></li>
            <?php } ?>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <?php
            $sql_t = "SELECT DISTINCT MONTHNAME(`tanggal`), YEAR(`tanggal`) FROM `blog` ORDER BY `tanggal`";
            $query_t = mysqli_query($koneksi, $sql_t);
            while ($data_t = mysqli_fetch_row($query_t)) {
              $month = $data_t[0];
              $year = $data_t[1];
            ?>
              <li><a href="index.php?include=blog-tanggal&data=<?php echo $month . "-" . $year; ?>"><?php echo $month . " " . $year; ?></a></li>
            <?php } ?>
          </ol>
        </div>


      </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </main><!-- /.container -->
</section><br><br>