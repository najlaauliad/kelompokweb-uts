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

        //getData
        $sql = "SELECT `b`.`tanggal`, `b`.`judul`, `b`.`isi`, `k`.`kategori_blog`, `u`.`nama`, `b`.`id_blog` FROM `blog` `b` INNER JOIN `kategori_blog` `k` ON `b`.`id_kategori_blog`=`k`.`id_kategori_blog` INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_row($query)) {
          $tanggal = $data[0];
          $judul = $data[1];
          $isi = $data[2];
          $kategori_blog = $data[3];
          $penulis = $data[4];
          $id_blog = $data[5] ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><a href="#" style="pointer-events: none;"><?php echo $judul; ?></a></h2>
            <hr>
            <p class="blog-post-meta"><?php echo $tanggal; ?> by <a href="#" style="pointer-events: none;"><?php echo $penulis; ?></a></p>
            <!--<img src=" slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->

            <p><?php echo limit_text($isi, 60); ?></p>
            <a href="index.php?include=detail-blog&data=<?php echo $id_blog ?>" class="btn btn-primary">Continue reading..</a>
          </div><!-- /.blog-post --><br><br>
        <?php } ?>

        <nav class="blog-pagination">
          <a class="btn btn-outline-primary" href="#">Older</a>
          <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
        </nav>

      </div><!-- /.blog-main -->

      <aside class="col-md-3 blog-sidebar">

        <div class="p-4">
          <h4 class="font-italic">Categories</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">Umum</a></li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">Java</a></li>
            <li><a href="#">Database</a></li>
            <li><a href="#">Techno</a></li>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
          </ol>
        </div>


      </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </main><!-- /.container -->
</section><br><br>