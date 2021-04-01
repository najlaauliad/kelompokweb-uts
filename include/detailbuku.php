<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <!-- Global CSS-->
    <link rel="stylesheet" href="dist/css/style.css">

    <title>Katalog Buku</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="#">Katalog Buku</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown07">
                    <a class="dropdown-item" href="daftarbuku.php">Java</a>
                    <a class="dropdown-item" href="daftarbuku.php">PHP</a>
                    <a class="dropdown-item" href="daftarbuku.php">HTML</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </div>
    </nav>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">DETAIL KATALOG</h1>
      </div>
    </section><br><br>
    <section id="katalog-wrapper">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 katalog-detail">
            <div class="table-responsive">
            <table class="table table-bordered">
            <?php
            $sql_d = "SELECT `b`.`cover`,`k`.`kategori_buku`,`b`.`judul`,
            `b`.`pengarang`, `b`.`tahun_terbit`,`p`.`penerbit`, `b`.`sinopsis`,
            `b`.`id_kategori_buku` FROM `buku` `b`
            INNER JOIN `kategori_buku` `k` ON
            `b`.`id_kategori_buku`=`k`.`id_kategori_buku`
            INNER JOIN `penerbit` `p` ON `b`.`id_penerbit`= `p`.`id_penerbit`
            WHERE `b`.`id_buku`='$id_buku'";
            $query_d = mysqli_query($koneksi,$sql_d);
            while($data_d = mysqli_fetch_row($query_d)){
              $cover = $data_d[0];
              $kategori_buku = $data_d[1];
              $judul_buku = $data_d[2];
              $pengarang = $data_d[3];
              $tahun_terbit = $data_d[4];
              $penerbit = $data_d[5];
              $sinopsis = $data_d[6];
              $id_kategori_buku = $data_d[7];
              //get tag
              $array_idtag = array();
              $array_tag = array();
              $sql_tb = "SELECT `tb`.`id_tag`, `t`.`tag` from `tag_buku` `tb`
              inner join `tag` `t` ON `tb`.`id_tag` = `t`.`id_tag`
              where `tb`.`id_buku`='$id_buku'";
              $query_tb = mysqli_query($koneksi,$sql_tb);
              while($data_tb = mysqli_fetch_row($query_tb)){
              $array_idtag[] = $data_tb[0];
              $array_tag[] = $data_tb[1];
              }

              ?>
              <tr>
                <td width="40%" rowspan="6">
                <img src="admin/cover/<?php echo $cover;?>" class="img-fluid"

                alt="<?php echo $judul_buku;?>"
                title="<?php echo $judul_buku;?>"></td>
                <td colspan="2"><h4><?php echo $judul_buku;?></h4></td>
              </tr>
              <tr>
                <td width="17%"><strong>Penulis</strong></td>
                <td width="43%"><?php echo $pengarang;?></td>
              </tr>
              <tr>
                <td><strong>Penerbit</strong></td>
                <td><?php echo $penerbit;?></td>
              </tr>
              <tr>
                <td><strong>Tahun Terbit</strong></td>
                <td><?php echo $tahun_terbit;?></td>
              </tr>
              <tr>
                <td><strong>Kategori Buku</strong></td>
                <td><?php echo $kategori_buku;?></td>
              </tr>
              <tr>
                <td><strong>Tag</strong></td>
                <td>
                  <?php
                  if(!empty($array_tag)){
                    $jumlah_tag = count($array_tag);
                    for($i=0;$i<$jumlah_tag;$i++){
                      if($i==($jumlah_tag-1)){ ?>
                        <a href="index.php?inclide=daftar-buku-tag&
                        <?php echo $array_idtag[$i];?>">
                        <?php echo $array_tag[$i];?></a>
                      <?php
                      }else{ ?>

                        <a href="index.php?inclide=daftar-buku-tag&
                        <?php echo $array_idtag[$i];?>">
                        <?php echo $array_tag[$i];?></a>,
                      <?php
                      }
                      ?>
                  <?php }}?>
                </td>
              </tr>
            <tr>
              <td colspan="3">
                <h5>Sinopsis</h5>
                <p><?php echo $sinopsis;?></p>
              </td>
            </tr>
            <?php }?>
            </table>
            </div><!-- .table-responsive -->

          </div><!-- /.blog-main -->
      
          <aside class="col-md-3 katalog-sidebar">
      
            
          <div class="pl-4 pb-4">
            <h4 class="font-italic">Buku Terkait</h4>
            <ol class="list-unstyled mb-0">
              <?php
              $sql_bt = "SELECT `id_buku`,`judul` FROM `buku` WHERE
              `id_kategori_buku`='$id_kategori_buku'
              ORDER BY rand() LIMIT 5";
              $query_bt = mysqli_query($koneksi,$sql_bt);
              while($data_bt = mysqli_fetch_row($query_bt)){
                $id_buku_terkait = $data_bt[0];
                $judul_buku_terkait = $data_bt[1];
              ?>
              <li><a href="index.php?include=detail-buku&
              data=<?php echo $id_buku_terkait;?>">
              <?php echo $judul_buku_terkait;?></a></li>
              <?php }?>
            </ol>
          </div>

          <div class="pl-4 pb-4">
            <h4 class="font-italic">Kategori</h4>
            <ol class="list-unstyled mb-0">
              <?php
              $sql_k = "SELECT `id_kategori_buku`,`kategori_buku`
              FROM `kategori_buku`
              ORDER BY `kategori_buku`";
              $query_k = mysqli_query($koneksi,$sql_k);
              while($data_k = mysqli_fetch_row($query_k)){
                $id_kat = $data_k[0];
                $nama_kat = $data_k[1];
              ?>
                <li><a href="index.php?include=daftar-buku-kategori&
                data=<?php echo $id_kat;?>">
                <?php echo $nama_kat;?></a></li>
              <?php }?>
            </ol>
          </div>
      
          <div class="p-4">
            <h4 class="font-italic">Tag</h4>
            <ol class="list-unstyled">
              <?php
              $sql_t = "SELECT `id_tag`,`tag` FROM `tag`
              ORDER BY `tag`";
              $query_t = mysqli_query($koneksi,$sql_t);
              while($data_t = mysqli_fetch_row($query_t)){
                $id_tag = $data_t[0];
                $nama_tag = $data_t[1];
              ?>
                <li><a href="index.php?include=daftar-buku-tag&
                data=<?php echo $id_tag;?>">
                <?php echo $nama_tag;?></a></li>
              <?php }?>
            </ol>
          </div>
          
          </aside><!-- /.blog-sidebar -->
      
        </div><!-- /.row -->
      
      </main><!-- /.container -->
    </section><br><br>
    <footer class="bg-primary text-dark">
        <div class="container">
          <p class="float-right">
            <a href="#" class="text-white">Back to top</a>
          </p>
          <p>&copy; <b>2021 Vokasi UB.</b> All rights reserved.</p>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>