<?php 
   session_start();

   // Inisialisasi variabel
   $totalSubtotal = 0;
   $totalPriceChecked = 0;
   // Periksa apakah ada produk dalam keranjang
   print_r($_SESSION['cart']);
   if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
     $totalQty = 0; // Digunakan untuk menghitung total produk di keranjang
     // Loop melalui produk dalam keranjang
     foreach ($_SESSION['cart'] as $productInfo) {
      $totalSubtotal += $productInfo['total']; // Menambahkan subtotal ke totalSubtotal
      $totalQty += $productInfo['qty'];
      }
    }
    
    // Inisialisasi total harga yang dipilih menjadi 0
    $totalPriceChecked = 0;// Digunakan untuk menghitung total produk di keranjang
    // Jika ada permintaan POST untuk menghapus produk yang dipilih
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_products']))
      $selectedProductIds = $_POST['selected_products'];
      $_SESSION['selected_products']['selectedIds'] = $selectedProductIds;
      // Filter item dalam session berdasarkan yang dicentang
      $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($productInfo) use ($selectedProductIds, &$totalPriceChecked) {
        if (in_array($productInfo['id_produk'], $selectedProductIds)) {
          $totalPriceChecked += $productInfo['total']; // Tambahkan total harga produk yang dicentang
          
          return false; // False untuk menghapus produk yang dicentang
        }
        return true; // True untuk menyimpan produk yang tidak dicentang
      });
// Inisialisasi total qty yang dipilih menjadi 0
$totalQtyChecked = 0;
// Jika ada permintaan POST untuk menghapus produk yang dipilih
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_products'])) {
    $selectedProductIds = $_POST['selected_products'];
    $_SESSION['selected_products']['selectedIds'] = $selectedProductIds;
    // Filter item dalam session berdasarkan yang dicentang
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($productInfo) use ($selectedProductIds, &$totalPriceChecked, &$totalQtyChecked) {
        if (in_array($productInfo['id_produk'], $selectedProductIds)) {
            $totalPriceChecked += $productInfo['total']; // Tambahkan total harga produk yang dicentang
            $totalQtyChecked += $productInfo['qty']; // Tambahkan total qty produk yang dicentang
            
            return false; // False untuk menghapus produk yang dicentang
        }
        return true; // True untuk menyimpan produk yang tidak dicentang
    });

    // Hitung kembali jumlah total produk yang tersisa di keranjang
    $totalQty = $totalQty - $totalQtyChecked;
      // Hitung kembali jumlah total produk yang tersisa di keranjang
      
      
      
      // Simpan informasi produk yang dipilih di dalam sesi
      $_SESSION['selected_products'] = [
        'totalPrice' => $totalPriceChecked,
        'qty' => $totalQty
      ];
       // Redirect ke halaman checkout atau tampilkan pesan sukses
       header('Location: tampil_checkout.php');
       exit();
   }
?>