<?php
if (isset($_GET['data'])) {
  $data = $_GET['data'];
  $_SESSION['data'] = $data;
}

if (empty($_GET['halaman']) && empty($_GET['data'])) {
  unset($_SESSION['katakunci_kategori']);
  unset($_SESSION['data']);
}

if (isset($_SESSION['data'])) {
  $id_kat = $_SESSION['data'];
  $sql_k = "SELECT `kategori_buku` FROM `kategori_buku` WHERE `id_kategori_buku`= '$id_kat'";
  $query_k = mysqli_query($koneksi, $sql_k);
  while ($data_k = mysqli_fetch_row($query_k)) {
    $kat = $data_k[0];
  }
}

if (isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}
?>

<section id="blog-header">
  <div class="container">
    <h1 class="text-white">DAFTAR BUKU</h1>
  </div>
</section><br><br>

<section id="katalog-item">
  <main role="main" class="container">
    <?php
    if (isset($_SESSION['data'])) {
      if (mysqli_num_rows($query_k) > 0) { ?>
        <h2 class="text-primary">CATEGORIES: <?php echo $kat; ?></h2><br><br>
      <?php } ?>
    <?php } else { ?>
      <h2 class="text-primary">CATEGORIES: ALL DATA</h2><br><br>
    <?php } ?>
    <div class="row">
      <div class="col-md-9 katalog-main">
        <div class="row">

          <!-- limit -->
          <?php
          $batas = 2;
          if (!isset($_GET['halaman'])) {
            $posisi = 0;
            $halaman = 1;
          } else {
            $halaman = $_GET['halaman'];
            if (!empty($halaman)) {
              $posisi = ($halaman - 1) * $batas;
            } else {
              $posisi = 0;
              $halaman = 1;
            }
          }

          //hitung jumlah semua data
          $sql_jum = "SELECT `b`.`id_buku`, `b`.`judul`, `b`.`cover`,`p`.`penerbit` FROM `buku` `b` INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit` ";
          if (!empty($data)) {
            $sql_jum .= " WHERE `b`.`id_kategori_buku`= '$data'";
          }
          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data / $batas); ?>

          <?php
          $sql_b = "SELECT `b`.`id_buku`, `b`.`judul`, `b`.`cover`,`p`.`penerbit` FROM `buku` `b` INNER JOIN `penerbit` `p` ON `b`.`id_penerbit` = `p`.`id_penerbit` ";
          //echo $sql_b;
          if (!empty($data)) {
            $sql_b .= " WHERE `b`.`id_kategori_buku`= '$data' ";
          }
          $sql_b .= " ORDER BY `b`.`judul` LIMIT $posisi, $batas";
          $query_b = mysqli_query($koneksi, $sql_b);

          //notif 0 data
          if (mysqli_num_rows($query_b) > 0) { ?>
          <?php } else { ?>
            <div class="col-sm-12">
              <div class="alert alert-danger" role="alert">Data Tidak Ditemukan</div>
            </div>
          <?php }

          while ($data_b = mysqli_fetch_row($query_b)) {
            $id_buku = $data_b[0];
            $judul_buku = $data_b[1];
            $cover = $data_b[2];
            $penerbit = $data_b[3];
          ?>

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img src="admin/cover/<?php echo $cover ?>" class="img-fluid" alt="Books Collection" title="Books" style="height: 300px; object-fit: cover;">
                <div class="card-body bg-warning">
                  <p class="card-text"><?php echo $judul_buku ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="index.php?include=detail-buku&data=<?php echo $id_buku ?>" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                    <small class="text-muted"><?php echo $penerbit ?></small>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div><!-- .row-->
        <ul class="pagination pagination-sm m-0 float-right">
          <?php
          if ($jum_halaman == 0) {
            //tidak ada halaman
          } else if ($jum_halaman == 1) {
            echo "<li class='page-item'><a class='page-link'>1</a></li>";
          } else {
            $sebelum = $halaman - 1;
            $setelah = $halaman + 1;
            if ($halaman != 1) {
              echo "<li class='page-item'><a class='page-link'href='index.php?include=daftar-buku&halaman=1'>First</a></li>";
              echo "<li class='page-item'><a class='page-link'href='index.php?include=daftar-buku&halaman=$sebelum'>«</a></li>";
            }
            for ($i = 1; $i <= $jum_halaman; $i++) {
              if ($i > $halaman - 5 and $i < $halaman + 5) {
                if ($i != $halaman) {
                  echo "<li class='page-item'><a class='page-link'href='index.php?include=daftar-buku&halaman=$i'>$i</a></li>";
                } else {
                  echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                }
              }
            }
            if ($halaman != $jum_halaman) {
              echo "<li class='page-item'><a class='page-link'href='index.php?include=daftar-buku&halaman=$setelah'>»</a></li>";
              echo "<li class='page-item'><a class='page-link'href='index.php?include=daftar-buku&halaman=$jum_halaman'>Last</a></li>";
            }
          } ?>
        </ul>
      </div><!-- /.katalog-main -->

      <aside class="col-md-3 katalog-sidebar">

        <div class="pl-4 pb-4">
          <h4 class="font-italic">Kategori</h4>
          <ol class="list-unstyled mb-0">
            <?php
            $sql_k = "SELECT `id_kategori_buku`,`kategori_buku`FROM `kategori_buku`ORDER BY `kategori_buku`";
            $query_k = mysqli_query($koneksi, $sql_k);
            while ($data_k = mysqli_fetch_row($query_k)) {
              $id_kat = $data_k[0];
              $nama_kat = $data_k[1];
            ?>
              <li><a href="index.php?include=daftar-buku-kategori&data=<?php echo $id_kat; ?>">
                  <?php echo $nama_kat; ?></a></li>
            <?php } ?>
          </ol>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Tag</h4>
          <ol class="list-unstyled">
            <?php
            $sql_t = "SELECT `id_tag`,`tag` FROM `tag`ORDER BY `tag`";
            $query_t = mysqli_query($koneksi, $sql_t);
            while ($data_t = mysqli_fetch_row($query_t)) {
              $id_tag = $data_t[0];
              $nama_tag = $data_t[1];
            ?>
              <li><a href="index.php?include=daftar-buku-tag&data=<?php echo $id_tag; ?>">
                  <?php echo $nama_tag; ?></a></li>
            <?php } ?>
          </ol>
        </div>
      </aside> <!-- /.katalog-sidebar -->

    </div><!-- /.row -->
  </main><!-- /.container -->
</section><br><br>