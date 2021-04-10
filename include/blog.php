<?php

if (isset($_GET['data'])) {
  $kategori_blog = $_GET['data'];
  $_SESSION['katakunci_kategori'] = $kategori_blog;
}
if (isset($_SESSION['katakunci_kategori'])) {
  $katakunci_kategori = $_SESSION['katakunci_kategori'];
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
        <?php
        //word limiter
        function limit_text($text, $limit)
        {
          if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
          }
          return $text;
        }

        //limit
        $batas = 2;
        if (!isset($_GET['halaman'])) {
          $posisi = 0;
          $halaman = 1;
        } else {
          $halaman = $_GET['halaman'];
          $posisi = ($halaman - 1) * $batas;
        }

        //hitung jumlah semua data
        $sql_jum = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
        if (!empty($katakunci_kategori)) {
          $sql_jum .= " WHERE `k`.`id_kategori_blog` LIKE '$katakunci_kategori' ";
        }
        $sql_jum .= " ORDER BY `tanggal` ";
        $query_jum = mysqli_query($koneksi, $sql_jum);
        $jum_data = mysqli_num_rows($query_jum);
        $jum_halaman = ceil($jum_data / $batas);

        //getData
        $sql = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
        if (!empty($katakunci_kategori)) {
          $sql .= " WHERE `k`.`id_kategori_blog` LIKE '$katakunci_kategori' ";
        }
        $sql .= " ORDER BY `tanggal` LIMIT $posisi, $batas ";
        $query = mysqli_query($koneksi, $sql);
        $no = $posisi + 1;
        if (mysqli_num_rows($query) > 0) {
          while ($data = mysqli_fetch_row($query)) {
            $tanggal = $data[0];
            $judul = $data[1];
            $isi = $data[2];
            $kategori_blog = $data[3];
            $penulis = $data[4];
            $id_blog = $data[5];

            $pieces = explode("-", $tanggal);
        ?>

            <div class="blog-post">
              <h2 class="blog-post-title"><a href="#" style="pointer-events: none;"><?php echo $judul; ?></a></h2>
              <hr>
              <p class="blog-post-meta"><?php echo $pieces[2] . "-" . $pieces[1] . "-" . $pieces[0]; ?> by <a href="#" style="pointer-events: none;"><?php echo $penulis; ?></a></p>
              <!--<img src=" slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->

              <p><?php echo limit_text($isi, 50); ?></p>
              <a href="index.php?include=detail-blog&data=<?php echo $id_blog ?>" class="btn btn-primary">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
          <?php } ?>

          <nav class="blog-pagination">
            <?php
            if ($jum_halaman == 0) {
              //tidak ada halaman
            } else if ($jum_halaman == 1) {
              //tidak ada halaman
            } else {
              $sebelum = $halaman - 1;
              $setelah = $halaman + 1;

              if ($jum_halaman > 1) {
                if ($halaman == $jum_halaman) {
                  echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum'>Older</a>";
                  echo " ";
                  echo "<a class='btn btn-outline-secondary disabled' href='#'>Newer</a>";
                } else {
                  if ($halaman != 1) {
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum'>Older</a>";
                    echo " ";
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' tabindex='-1' aria-disabled='true'>Newer</a>";
                  } else {
                    echo "<a class='btn btn-outline-secondary disabled' href='index.php?include=blog&halaman=$sebelum'>Older</a>";
                    echo " ";
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah' tabindex='-1' aria-disabled='true'>Newer</a>";
                  }
                }
              }
            } ?>
          </nav>
        <?php } else { ?>
          <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">Data Tidak Ditemukan</div>
          </div>
        <?php } ?>



      </div><!-- /.blog-main -->

      <aside class="col-md-3 blog-sidebar">

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