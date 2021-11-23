<?php
    require 'model/function.php';

    $buku = query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BukuKu</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><i class="bi bi-book"></i> BukuKu</h3>
            </div>
            <ul class="flex-column navbar-nav">
                <li class="nav-item mb-3 fw-bold">
                    <a class="nav-link link-light" href="#">
                        Beranda
                    </a>
                </li>
                <li class="nav-item mb-3 fw-bold">
                    <a class="nav-link text-dark bg-light" href="#">
                        <b>Katalog</b>
                    </a>
                </li>
                <li class="nav-item mb-3 fw-bold">
                    <a class="nav-link link-light" href="#">
                        Pesanan
                    </a>
                </li>
                <li class="nav-item mb-3 fw-bold">
                    <a class="nav-link link-light" href="#">
                        Pembukuan
                    </a>
                </li>
            </ul>
        </nav>
        <div id="content" class="px-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid mt-2 d-block d-md-none">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <a href="tambah.php" class="btn btn-primary mt-3">Tambah Buku</a>
            <hr>
            <div class="row mt-2 konten">
                <?php foreach ($buku as $b) : ?>
                    <div class="col-md-4 p-2 col-sm-5 p-2">
                        <div class="card shadow-sm rounded h-100">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="images/<?= $b['gambar'] ?>" class="img-fluid rounded h-100" alt="<?= $b['judul'] ?>">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body p-2">
                                        <h6 class="card-title lead"><?= $b['judul'] ?></h6> 
                                        <p class="card-text"><small class="text-muted"><?= $b['penulis'] ?> | <?= $b['penerbit'] ?> <br> <b><?= $b['kategori'] ?></b></small></p>
                                        <div class="button-group d-flex p-auto">
                                            <a href="ubah.php?id=<?= $b['id'] ?>" class="btn btn-warning btn-sm d-md-block">Edit</a>
                                            <a href="hapus.php?id=<?= $b['id'] ?>" class="btn btn-danger btn-sm ml-2 d-md-block" onclick="return confirm('Apakah anda yakin?');">Hapus</a>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
		    </div>
        </div>
    </div>    
    


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        });
    </script>
</body>

</html>