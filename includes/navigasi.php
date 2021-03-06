<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Katalog Buku</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">

                <!-- home -->
                <?php
                if (!empty($_GET['include'])) {
                    if ($_GET['include'] == "about-us") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else if ($_GET['include'] == "daftar-buku") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else if ($_GET['include'] == "blog") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else if ($_GET['include'] == "contact-us") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>

                    <!-- about us -->
                    <?php
                    if ($_GET['include'] == "about-us") { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?include=about-us">About Us</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?include=about-us">About Us</a>
                        </li>
                    <?php } ?>

                    <!-- kategori_buku -->
                    <li class="nav-item dropdown">
                        <?php
                        if ($_GET['include'] == "daftar-buku") { ?>
                            <a class="nav-link dropdown-toggle active" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria- expanded="false">Kategori</a>
                        <?php } else { ?>
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria- expanded="false">Kategori</a>
                        <?php } ?>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                            <?php
                            $sql_k = "SELECT `id_kategori_buku`,`kategori_buku` FROM `kategori_buku` ORDER BY `kategori_buku`";
                            $query_k = mysqli_query($koneksi, $sql_k);
                            while ($data_k = mysqli_fetch_row($query_k)) {
                                $id_kat = $data_k[0];
                                $kat = $data_k[1];
                            ?>
                                <a class="dropdown-item" href="index.php?include=daftar-buku&data=<?php echo $id_kat; ?>"><?php echo $kat; ?></a>
                            <?php } ?>
                        </div>
                    </li>

                    <!-- blog -->
                    <?php
                    if ($_GET['include'] == "blog") { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?include=blog">Blog</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?include=blog">Blog</a>
                        </li>
                    <?php } ?>

                    <!-- contact us -->
                    <?php
                    if ($_GET['include'] == "contact-us") { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?include=contact-us">Contact Us</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?include=contact-us">Contact Us</a>
                        </li>
                    <?php }
                } else { ?>
                    <!-- home -->
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home
                            <span class="sr-only">(current)</span></a>
                    </li>

                    <!-- about us -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?include=about-us">About Us</a>
                    </li>

                    <!-- kategori_buku -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria- expanded="false">Kategori</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                            <?php
                            $sql_k = "SELECT `id_kategori_buku`,`kategori_buku` FROM `kategori_buku` ORDER BY `kategori_buku`";
                            $query_k = mysqli_query($koneksi, $sql_k);
                            while ($data_k = mysqli_fetch_row($query_k)) {
                                $id_kat = $data_k[0];
                                $kat = $data_k[1];
                            ?>
                                <a class="dropdown-item" href="index.php?include=daftar-buku&data=<?php echo $id_kat; ?>"><?php echo $kat; ?></a>
                            <?php } ?>
                        </div>
                    </li>

                    <!-- blog -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?include=blog">Blog</a>
                    </li>

                    <!-- contact us -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?include=contact-us">Contact Us</a>
                    </li>
                <?php } ?>

            </ul>
            <form class="form-inline mt-2 mt-md-0" method="post" action="index.php?include=search">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="katakunci">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="katakunci_buku">Search</button>
            </form>

        </div>
    </div>
</nav>