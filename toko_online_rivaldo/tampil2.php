<?php  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../toko_online_rivaldo/css/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
<?php
include "koneksi.php";
$querry_in = mysqli_query($conn,"select * from detail_transaksi join produk on detail_transaksi.id_produk = produk.id_produk");
$res = mysqli_query($conn,"select count(*) as total_data from detail_transaksi");
$row = mysqli_fetch_assoc($res);
$jumlah_produk = $row['total_data'];
session_start();


// ... Kode lainnya untuk menampilkan produk yang ada di dalam $cart ...

?>
        <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
              <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                  <div class="row g-0">
                    <div class="col-lg-8">
                      <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                          <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                          <h6 class="mb-0 text-muted"><?php echo count($_SESSION['cart']); ?> Item </h6>
                        </div>

                        <?php 
                            if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                              foreach($_SESSION['cart'] as $productInfo) {
                                  $id_produk = $productInfo['id_produk'];
                                  $nama_produk = $productInfo['nama_produk'];
                                  $harga = $productInfo['harga'];
                                  $qty = $productInfo['qty'];
                                  $jenis = $productInfo['jenis'];
                                  $total = $productInfo['total'];
                                  $foto = $productInfo['foto'];

                              ?>                              
                              
                              <form action="checkout.php" method="post" >

                              <hr class="my-4">
                              
                              <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-1 col-lg-1 col-xl-1">
                                  <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="<?=$id_produk?>" id="checkbox<?=$id_produk?>" name="selected_products[]">
                                  <label class="form-check-label" for="checkbox<?=$id_produk?>"></label>
                                </div>
                              </div>
                              <div class="col-md-2 col-lg-2 col-xl-2">
                                <img
                                src="../toko_online_rivaldo/foto_produk/<?=$foto?>"
                                class="img-fluid rounded-3" alt="Cotton T-shirt">
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3">
          <h6 class="text-muted"><?= $jenis ?></h6>
          <h6 class="text-black mb-0"><?= $nama_produk?></h6>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
          <input id="form1" min="<?=$qty?>" max="<?=$qty?>" name="quantity" value="<?=$qty?>" type="number"
          class="form-control form-control-sm" readonly />
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2">
          <h6 class="mb-0"><?=number_format($total, 0, ',', '.')?></h6>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
    <a href="hapus_produk.php?id_produk=<?=$id_produk?>" class="text-muted"><i class="fas fa-times"></i></a>
</div>
      </div>
                    
                    <hr class="my-4">
                            <?php 
                            }
                          }?>
                    
                    
                    <button type="submit" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark" >Checkout</button>
                  </form>
                    <div class="pt-5">
                      <h6 class="mb-0"><a href="index.php" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
</html>