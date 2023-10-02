<?php 
    include "koneksi.php";
    session_start();
    if($_SESSION['status_login']!="ture"){
        echo "<script>alert('Silahkan login dulu');location.href=login.php</script>";
    }
    else{
        $qry_p = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = '".$_GET['id_produk']."'");
        $fetch = mysqli_fetch_array($qry_p);
        $qry_k = mysqli_query($conn,"insert into keranjang(id_keranjang,id_produk,total_harga,total_qty) value('','".$_GET['id_produk']."','','') ");
        header("location: tampil.ph");
    }
?>