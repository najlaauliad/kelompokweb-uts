<?php
if (isset($_GET['data'])) {
  $kategori_blog = $_GET['data'];
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

        $batas = 2;
        if (!isset($_GET['halaman'])) {
          $posisi = 0;
          $halaman = 1;
        } else {
          $halaman = $_GET['halaman'];
          $posisi = ($halaman - 1) * $batas;
        }
        
        $sql_jum = "select id_blog, kategori_blog.kategori_blog, `judul`, `tanggal`, user.nama 
                  from blog 
                  INNER JOIN kategori_blog ON blog.id_kategori_blog = kategori_blog.id_kategori_blog 
                  INNER JOIN user ON blog.id_user = user.id_user";
        $sql_jum .= " order by `judul`";
        $query_jum = mysqli_query($koneksi, $sql_jum);
        $jum_data = mysqli_num_rows($query_jum);
        $jum_halaman = ceil($jum_data/$batas);


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
        
        $sql_k = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
          if (!empty($katakunci_blog)) {
            $sql_k .= " WHERE `k`.`id_kategori_blog` LIKE '$kategori_blog' LIMIT 3";
          }
        //getData
        $sql = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
        if (!empty($kategori_blog)) {
          $sql .= " WHERE `k`.`id_kategori_blog` LIKE '$kategori_blog' LIMIT 3";
        }else{
          $sql .= " LIMIT 3";
        }$query = mysqli_query($koneksi, $sql);

        
          
          if (mysqli_num_rows($query) > 0) {
          $sql_k .= " ORDER BY `judul` limit $posisi, $batas ";
          $query_k = mysqli_query($koneksi, $sql_k);
          $no = $posisi + 1;
          while ($data = mysqli_fetch_row($query_k)) {
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
          <?php  } ?>
          <nav class="blog-pagination">
          <?php
            if ($jum_halaman==0) {
              //tidak ada halaman
            } elseif ($jum_halaman==1) {

            } else {
              $sebelum = $halaman-1;
              $setelah = $halaman+1;
              if($halaman==1) {
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah'><i class='icon-chevron-right'></i> Old</a>";
                
              } else if($halaman==$jum_halaman) {
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum'> <i class='icon-chevron-left'></i> New </a>";
                
              } elseif($halaman>1 && $halaman<$jum_halaman) {
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$sebelum'> <i class='icon-chevron-left'></i> New </a>";
                    echo "<a class='btn btn-outline-primary' href='index.php?include=blog&halaman=$setelah'><i class='icon-chevron-right'></i> Old</a>";
                
              }
            }
            ?>
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