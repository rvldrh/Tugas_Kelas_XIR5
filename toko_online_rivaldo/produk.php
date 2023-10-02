<?php 
    include 'koneksi.php';
    $foto_tmp = $_FILES['foto']['tmp_name'];
    
    if($_POST){
        $nama_barang = $_POST['nama_barang'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $jenis = $_POST['jenis'];
        
        $nama_foto = uniqid();
        $nama_foto .= '.jpg';
        // echo $nama_foto;
        $dir = "./foto_produk/".$nama_foto;
        move_uploaded_file($foto_tmp, $dir);

        if(empty($nama_barang)){
            echo "<script> alert('Maaf nama Tidak Boleh Kosong');location.href='produk.php' </script>";
        }
        elseif(empty($deskripsi)){
            echo "<script> alert('Maaf alamat Tidak Boleh Kosong');location.href='produk.php' </script>";            
        }
        elseif(empty($harga)){
            echo "<script> alert('Maaf nomor telepon Tidak Boleh Kosong');location.href='produk.php' </script>";
        }
        else{
            $insert_produk = mysqli_query($conn,"insert into produk(nama_produk,deskripsi,foto_produk,harga,jenis) value('$nama_barang','$deskripsi','$nama_foto','$harga','$jenis')");
            if($insert_produk){
              echo "<script> alert('Input produk berhasil');location.href='index.php' </script>";
            }
        }
        

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Input Pembeli</title>
</head>
<body>
<div class="card">
  <h4 class="card-header">
    Input Produk
</h4>
  <div class="card-body">
  <form action="produk.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
        <input name="nama_barang" type="text" class="form-control" id="">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
        <input name="deskripsi" type="text" class="form-control" id="">
      </div>
      <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" multiple="multiple" name="foto" id="foto" value="" class="form-control" accept=".jpg .jpeg .png">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Harga</label>
        <input name="harga" type="text" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Jenis</label>
        <select name="jenis" id="">
          <option value=""></option>
          <option value="fashion">fashion</option>
          <option value="elektronik">elektronik</option>
          <option value="makanan/minuman">makanan / minuman</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</body>
</html>