<?php 
    session_start();
    session_destroy();
    echo "<script>alert('berhasil logout produk');location.href='index.php'</script>";
?>