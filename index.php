<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Rekomendasi Buku</title>
    <meta charset="UTF-8">
    <meta name="description" content="Game Warrior Template">
    <meta name="keywords" content="warrior, game, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/animate.css" />


    <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <?php
    // Path file CSV
    $file_path = "data/recomender_result.csv";

    // Membaca file CSV ke dalam array dengan menggunakan delimiter "|"
    $csv_data = array_map(function ($row) {
        return str_getcsv($row, "|");
    }, file($file_path));

    // Menghapus baris header
    $header = array_shift($csv_data);
    ?>

    <!-- Header section -->
    <header class="header-section">
        <div class="container">
            <!-- logo -->
            <a class="site-logo" href="index.html">
                <img src="img/logo.png" alt="">
            </a>
            <!-- responsive -->
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <!-- site menu -->
            <nav class="main-menu">
                <ul>
                    <li><a href="#rekomendasi">Rekomendasi</a></li>
                    <li><a href="#databuku">Data Buku</a></li>
                    <li><a href="#terbaru">Terbaru</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Header section end -->


    <!-- Hero section -->
    <section class="hero-section">
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="img/slider-1.jpg">
            <div class="hs-text">
                <div class="container">
                    <h2>Temukan <span> Buku </span> Terbaik</h2>
                    <p>Temukan rekomendasi buku terbaik <br> untuk menemani perjalanan literasi Anda. <br> Anda dapat menemukan karya-karya luar biasa <br> yang akan memikat hati dan pikiran Anda.</p>
                    <a href="#mulai" class="site-btn">Mulai</a>
                </div>
            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="img/slider-2.jpg">
            <div class="hs-text">
                <div class="container">
                <h2>Terinspirasi Melalui <span> Buku </span></h2>
                <p>Nikmati pengalaman literasi yang luar biasa <br> dengan rekomendasi buku terbaik kami. <br> Jelajahi koleksi kami untuk menemukan karya-karya <br> yang akan memikat hati dan pikiran Anda.</p>
                <a href="#mulai" class="site-btn">Mulai</a>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Hero section end -->


    <!-- Latest news section -->

    <div class="latest-news-section">
        <div class="ln-title" id="mulai">Quotes</div>
        <div class="news-ticker">
            <div class="news-ticker-contant">
                <!-- Tambahkan kutipan-kutipan berikut -->
                <div class="nt-item"><span class="new">Stephen King</span>"Buku adalah sebuah portal sihir."</div>
                <div class="nt-item"><span class="strategy">Abraham Lincoln</span>"Hal-hal yang ingin kutahu ada di dalam buku, sahabat terbaik adalah orang yang akan memberikanku sebuah buku yang belum aku ketahui."</div>
                <div class="nt-item"><span class="racing">Haruki Murakami</span>"Kalau engkau hanya membaca buku yang dibaca semua orang, engkau hanya bisa berpikir sama seperti semua orang."</div>
            </div>
        </div>
    </div>

    <!-- Latest news section end -->


    <!-- Recent game section  -->
    <section class="recent-game-section spad set-bg" data-setbg="img/recent-game-bg.png">
        <div class="container">
            <div class="section-title" id="terbaru">
                <div class="cata new">Baru</div>
                <h2>Buku Terbaru</h2>
            </div>
            <div class="row">

                <?php
                function compareByYear($a, $b)
                {
                    $yearA = isset($a[8]) ? $a[8] : 0;
                    $yearB = isset($b[8]) ? $b[8] : 0;
                    return $yearB - $yearA;
                }

                usort($csv_data, "compareByYear");

                // Menampilkan hanya 3 data terbaru
                $count = 0;
                foreach ($csv_data as $row) {
                    // Pastikan indeks yang diakses tersedia dalam baris
                    if (
                        isset(
                            $row[2],
                            $row[1],
                            $row[3],
                            $row[4],
                            $row[7],
                            $row[8]
                        )
                    ) {

                        $bookTitle = $row[2]; // Kolom Book-Title
                        $authorIsbnPublisher = "Author : {$row[1]} <br> ISBN : {$row[3]} <br> Publisher : {$row[7]}"; // Kolom Book-Author, ISBN, Publisher
                        $yearOfPublication = $row[8]; // Kolom Year-Of-Publication
                        $imageURL = $row[4];

                        // Kolom Image-URL-L

                        // HTML template
                        ?>
                <div class="col-lg-4 col-md-6">
                    <div class="recent-game-item">
                        <div class="rgi-thumb set-bg" data-setbg="<?php echo $imageURL; ?>">
                            <div class="cata new"><?php echo $yearOfPublication; ?></div>
                        </div>
                        <div class="rgi-content">
                            <h5><?php echo $bookTitle; ?></h5>
                            <p><?php echo $authorIsbnPublisher; ?></p>
                            <div class="rgi-extra">
                                <div class="rgi-star"><img src="img/icons/star.png" alt=""></div>
                                <div class="rgi-heart"><img src="img/icons/heart.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // Increment counter
                $count++;

                // Break the loop if 3 items are already displayed
                if ($count >= 3) {
                    break;
                }

                    }
                }
                ?>


            </div>
        </div>
    </section>
    <!-- Recent game section end -->


    <!-- Tournaments section -->
    <?php 

$newestBook = $csv_data[0];
$newestBookTitle = $newestBook[2];
$newestBookAuthor = $newestBook[1];
$newestBookISBN = $newestBook[3];
$newestBookPublisher = $newestBook[7];
$newestBookYear = $newestBook[8];
$newestBookImageURL = $newestBook[4];

// Menampilkan buku terlama
$oldestBook = end($csv_data);
$oldestBookTitle = $oldestBook[2];
$oldestBookAuthor = $oldestBook[1];
$oldestBookISBN = $oldestBook[3];
$oldestBookPublisher = $oldestBook[7];
$oldestBookYear = $oldestBook[8];
$oldestBookImageURL = $oldestBook[4];
?>

    <section class="tournaments-section spad">
        <div class="container " id="databuku">
            <div class="tournament-title">Rentang Data Kami</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="tournament-item mb-4 mb-lg-0">
                        <div class="ti-notic">Data Buku Terbaru Kami</div>
                        <div class="ti-content">
                            <div class="ti-thumb set-bg" data-setbg="<?php echo $newestBookImageURL; ?>"></div>
                            <div class="ti-text">
                                <h4><?php echo $newestBookTitle; ?></h4>
                                <ul>
                                    <li><span>Pengarang:</span> <?php echo $newestBookAuthor; ?></li>
                                    <li><span>ISBN:</span> <?php echo $newestBookISBN; ?></li>
                                    <li><span>Publisher:</span> <?php echo $newestBookPublisher; ?></li>
                                    <li><span>Tahun Terbit:</span> <?php echo $newestBookYear; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tournament-item">
                        <div class="ti-notic">Data Buku Terlama Kami</div>
                        <div class="ti-content">
                            <div class="ti-thumb set-bg" data-setbg="<?php echo $oldestBookImageURL; ?>"></div>
                            <div class="ti-text">
                                <h4><?php echo $oldestBookTitle; ?></h4>
                                <ul>
                                    <li><span>Pengarang:</span> <?php echo $oldestBookAuthor; ?></li>
                                    <li><span>ISBN:</span> <?php echo $oldestBookISBN; ?></li>
                                    <li><span>Publisher:</span> <?php echo $oldestBookPublisher; ?></li>
                                    <li><span>Tahun Terbit:</span> <?php echo $oldestBookYear; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tournaments section bg -->


    <!-- Review section -->
    <section class="review-section spad set-bg" data-setbg="img/review-bg.png">
        <div class="container">
            <div class="section-title" id = "rekomendasi">

                <h2> Buku Berdasarkan Rating</h2>
            </div>
            <?php
            // Menentukan indeks kolom "average_rating" dan "Year-Of-Publication"
            $averageRatingIndex = array_search("score", $header);
            $yearOfPublicationIndex = array_search(
                "Year-Of-Publication",
                $header
            );
            $isbnIndex = array_search("ISBN", $header);
            $rowKeyIndex = array_search("row_key", $header);

            // Fungsi untuk membandingkan dua data berdasarkan average rating
            // Fungsi untuk membandingkan dua data berdasarkan average rating
            function compareByRating($a, $b)
            {
                global $averageRatingIndex;

                // Memastikan kolom average_rating ada pada setiap baris
                if (
                    isset($a[$averageRatingIndex]) &&
                    isset($b[$averageRatingIndex])
                ) {
                    // Membandingkan secara numerik
                    $ratingA = (float) $a[$averageRatingIndex];
                    $ratingB = (float) $b[$averageRatingIndex];

                    return $ratingB <=> $ratingA;
                }

                return 0;
            }

            // Mengurutkan array berdasarkan average rating
            usort($csv_data, "compareByRating");

            // Mengambil 4 baris pertama
            $csv_data_subset = array_slice($csv_data, 0, 4);
            ?>
            <div class="row">
                <?php foreach ($csv_data_subset as $row): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="review-item">
                        <div class="review-cover set-bg" data-setbg="<?= $row[4] ?>">
                            <div class="score yellow"><?php echo number_format(
                                (float) $row[11],
                                2
                            ); ?></div>
                        </div>
                        <div class="review-text">
                            <h5><?php echo $row[2]; ?></h5>
                            <p><?php echo "Author : {$row[1]} <br> ISBN : {$row[3]} <br> Publisher : {$row[7]}"; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <!-- Review section end -->


    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <ul class="footer-menu">
                <li><a href="https://id.linkedin.com/in/mohamad-syarifudin-efendi-9b2184158">K3520043 MS Efendi </a></li>
                <li><a href="https://www.youtube.com/channel/UCtPmEg2El7VtuPEugHr7hKA">K3520057 Nur Falah A </a></li>
                <li><a href="https://id.linkedin.com/in/zainuri-septian-wahyu-anggoro-611917299">K3520082 Zainuri SWA </a></li>
            </ul>
            <p class="copyright">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | Big Data Kelompok 3</a> 
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </footer>
    <!-- Footer section end -->


    <!--====== Javascripts & Jquery ======-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.marquee.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>