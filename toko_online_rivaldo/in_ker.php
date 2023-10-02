<?php 
    include "koneksi.php";
    $querry_in = mysqli_query($conn,"select * from produk where id_produk='".$_GET['id_produk']."'");
    $fetch_in = mysqli_fetch_array($querry_in);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Item - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../toko_online_rivaldo/keranjang/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <?php 
            include "header.php";
            include "koneksi.php";
            session_start(); // Mulai session

                        if ($_POST) {
                            // Ambil informasi produk dari formulir atau database (jika menggunakan database)
                            $productInfo = [
                                'id_pelanggan' => $_SESSION['id_pelanggan'],
                                'id_produk' => $_POST['id_produk'], // Contoh: ID produk dari database
                                'nama_produk' => $_POST['nama_produk'],
                                'harga' => $_POST['harga'],
                                'qty' => $_POST['qty'],
                                'foto' => $fetch_in['foto'],
                                'jenis' => $fetch_in['jenis'],
                                'total' => $_POST['harga'] * $_POST['qty']
                                // Informasi lainnya sesuai kebutuhan
                            ];
                        
                            // Simpan produk ke dalam session
                            $_SESSION['cart'][] = $productInfo;
                        }
        ?>
        <!-- Product section-->
        <form action="masukkeranjang.php?id_produk=<?=$fetch_in['id_produk']?>" method="post" >
            <section class="py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../toko_online_rivaldo/foto_produk/<?=$fetch_in['foto_produk']?>"/></div>
                        <div class="col-md-6">
                            <div class="small mb-1">SKU: BST-498</div>
                            <h1 class="display-5 fw-bolder"><?=$fetch_in['nama_produk']?></h1>
                            <div class="fs-5 mb-5">
                                <span class="text-decoration-line-through"><?=$fetch_in['harga']?></span>
                                <span>Rp <?=number_format($fetch_in['harga'], 0, ',', '.')?></span>
                            </div>
                            <p class="lead"><?=$fetch_in['deskripsi']?></p>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" name="qty" style="max-width: 3rem" />
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    


        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                        include "koneksi.php";
                        $qry_produk = mysqli_query($conn,"select * from produk");
                        while($arr_produk=mysqli_fetch_array($qry_produk)){?>
                        <form action="in_ker.php?id_produk=<?=$arr_produk['id_produk']?>" method="post">
                            <div class="col mb-5" style="box-shadow: 4px 4px 5px -4px";>
                                <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="../toko_online_rivaldo/foto_produk/<?=$arr_produk['foto_produk']?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=$arr_produk['nama_produk']?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <p>Rp.<?=$arr_produk['harga']?></p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="submit">Add to cart</button></div>
                            </div>
                        </div>
                    </div>
                </form>
                    <?php
                        }?>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
