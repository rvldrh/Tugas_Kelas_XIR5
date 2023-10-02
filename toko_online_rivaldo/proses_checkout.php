<?php 
    session_start();
    // Periksa apakah ada data pembelian yang akan disimpan
    if (isset($_SESSION['selected_products'])) {
        // Ambil data dari sesi
        $totalPriceChecked = $_SESSION['selected_products']['totalPrice'];
        $qty = $_SESSION['selected_products']['qty'];
        
        // Inisialisasi koneksi ke database
        include "koneksi.php";
        
        // Inisialisasi data lain yang diperlukan, seperti id_pelanggan
        $id_pelanggan = $_SESSION['id_pelanggan']; // Gantilah ini dengan cara Anda mengambil id_pelanggan
        echo $totalPriceChecked;
        print_r($_SESSION['cart']);
        // Loop melalui produk yang ada dalam keranjang dan simpan data ke tabel histori_pembelian
        foreach ($_SESSION['cart'] as $productInfo) {
            $id_produk = $productInfo['id_produk'];
            $subtotal = $productInfo['total'];
            echo $subtotal;
            
            // Lakukan proses insert untuk setiap produk yang dibeli
            $query = mysqli_query($conn,"insert into histori_pembelian(id_pelanggan,id_produk,subtotal) value('$id_pelanggan','$id_produk','$totalPriceChecked') ");
            if ($query) {
                // Hapus produk dari keranjang belanja setelah berhasil memasukkan ke histori_pembelian
                // Anda bisa menambahkan kode di sini untuk menghapus produk dari sesi keranjang
            } else {
                // Jika ada kesalahan dalam query, Anda dapat menangani sesuai kebutuhan Anda
                echo "Terjadi kesalahan dalam memproses pembelian.";
            }
            
        }
    
        // Hapus data dari keranjang belanja setelah berhasil memasukkan ke histori_pembelian
        unset($_SESSION['cart']);
        unset($_SESSION['selected_products']);
    
        // Redirect ke halaman sukses atau halaman lain yang Anda inginkan
        // header('Location: tampil_sukses.php');
        exit();
    } else {
        // Jika tidak ada data pembelian yang akan disimpan, Anda dapat menangani sesuai kebutuhan Anda
        echo "Tidak ada data pembelian yang akan disimpan.";
    }
?>