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
        <div class="col-md-7">
        <h2 class="featurette-heading">
          <?php echo $judul_konten; ?></span></h2>
        <p class="lead"><?php echo $isi_konten; ?></p>
      </div>
      <div class="col-md-5">
        <img src="images/undraw_book_lover_mkck.png" class="img-fluid mx-auto featurette-image">
      </div><!-- /.blog-main -->
      
         
      
            <div class="p-4">
              <h4 class="font-italic">Social Media</h4>
              <ol class="list-unstyled">
                <li><a href="#">GitHub</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
              </ol>
            </div>
          </aside>--><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section><br><br>