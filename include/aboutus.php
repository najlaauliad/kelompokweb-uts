<?php
$sql_k = "SELECT `judul`,`isi` FROM `konten` WHERE
`id_konten`='3'";
$query_k = mysqli_query($koneksi, $sql_k);
while ($data_k = mysqli_fetch_row($query_k)) {
  $judul_konten = $data_k[0];
  $isi_konten = $data_k[1];
}
?>
<section id="blog-header">
  <div class="container">
    <h1 class="text-white">ABOUT US</h1>
  </div>
</section><br><br>

<section id="blog-list">
  <main role="main" class="container">
    <div class="row">
      <div class="col-md-9 blog-main">
        <div class="blog-post">
          <h2 class="blog-post-title">
            <?php echo $judul_konten; ?></span></h2>
          <p class="lead"><?php echo $isi_konten; ?></p>
        </div><br><br><!-- /.blog-post -->
      </div><!-- /.blog-main -->




      <div class="p-4">
        <h4 class="font-italic">Social Media</h4>
        <ol class="list-unstyled">
          <li><a href="https://github.com/">GitHub</a></li>
          <li><a href="https://twitter.com/">Twitter</a></li>
          <li><a href="https://www.facebook.com/">Facebook</a></li>
          <li><a href="https://www.instagram.com/">Instagram</a></li>
        </ol>
      </div>


    </div><!-- /.row -->

  </main><!-- /.container -->
</section><br><br>