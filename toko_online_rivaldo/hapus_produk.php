<?php
session_start();

// Inisialisasi variabel yang akan digunakan
$success = false; // Variabel ini akan digunakan untuk menandai apakah penghapusan berhasil

// Periksa apakah ada ID produk yang akan dihapus di URL
if (isset($_GET['id_produk'])) {
    $idProdukYangDihapus = $_GET['id_produk'];

    // Loop melalui produk dalam keranjang belanja
    foreach ($_SESSION['cart'] as $key => $productInfo) {
        // Jika ID produk cocok dengan yang akan dihapus, hapus produk tersebut
        if ($productInfo['id_produk'] == $idProdukYangDihapus) {
            unset($_SESSION['cart'][$key]);
            $success = true; // Tandai bahwa penghapusan berhasil
            break; // Keluar dari loop setelah menghapus produk
        }
    }
}

// Redirect kembali ke halaman keranjang belanja atau halaman lain jika diperlukan
if ($success) {
    header('Location: tampil2.php'); // Ganti "tampil2.php" dengan halaman keranjang belanja Anda
} else {
    // Redirect dengan pesan kesalahan jika penghapusan gagal
    header('Location: tampil2.php?error=1'); // Ganti "tampil2.php" dengan halaman keranjang belanja Anda
}
?>
