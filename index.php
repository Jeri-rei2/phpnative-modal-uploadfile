

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="le-edge">
    <title>modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
 
<div class="container">
<br />
<p><button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah data</button><p>
    
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'koneksi.php';
                $no = 1;
                $tampil = $conn->query( "SELECT * FROM data");
                while($data = mysqli_fetch_array($tampil)):
            
            
            ?>
             <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['kelas'] ?></td>
                        <td><?php if($data['jk'] === "0"): echo "Perempuan"; else: echo "Laki-Laki";
                         endif; ?></td>
                        <td><?= $data['tgl_lahir'] ?> </td>
                        <td><?= $data['alamat'] ?></td>
                    <td>
                        <a href="javascript void(0)" data-toggle="modal" data-target="#deleteModal" 
                        <?= $data['id'] ?> class="btn btn-danger">Hapus</a>
                        <a href="javascript void(0)"  data-toggle="modal" data-target="#editModal" 
                        <?= $data['id'] ?>  class="btn btn-primary">Edit</a>
                        <a href="javascript void(0)"  data-toggle="modal" data-target="#uploadModal" 
                        <?= $data['id'] ?>  class="btn btn-warning">Upload file</a>
                    </td>
                </tr>

                 <!-- upload file -->
                 <div class="modal fade" id="uploadModal" 
                        <?= $data['id'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Uplod File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <input type="file" name="fileupload">
                                                <input type="submit" value="Upload">
                                            </form>
                                    </div>
                                    <div class="modal-footer">
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- modal hapus -->
                    <div class="modal fade" id="deleteModal" 
                        <?= $data['id'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <h3 class="text-center">Yakin ingin menghaspus data..?</h3>
                                    </div>
                                    <div class="modal-footer">
                                      <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?=$data['id']  ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="delete" class="btn btn-primary">Yakin</button>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    
     <!-- modal edit -->
    <div class="modal fade" id="editModal" 
                        <?= $data['id'] ?> tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" 
                            required value="<?= $data['nama']  ?>">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Kelas:</label>
                            <select name="kelas" class="form-control" required>
                                <optgroup label="Terpilih">
                                    <option value="<?= $data['kelas'] ?>"><?= $data['kelas'] ?></option>
                                </optgroup>
                                <optgroup label="Pilihan">
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </optgroup>
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tgl_lahir" required value="<?= $data['tgl_lahir'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Jenis Kelamin:</label>
                            <select name="jk" class="form-control" required>
                            <optgroup label="Terpilih">
                                <?php if($data['jk'] === "0"): $jk = 'Perempuan'; else: $jk = 'Laki-laki'; endif; ?>
                                    <option value="<?= $jk ?>"><?= $jk ?></option>
                                </optgroup>
                                <optgroup label="Pilihan">
                                    <option value="1">Laki-Laki</option>
                                    <option value="0">Perempuan</option>
                                </optgroup>
                                   
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat:</label>
                           <textarea class="form-control" name="alamat" rows="2" placeholder="alamat lengkap" required><?= $data['alamat'] ?> </textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                </div>
                
                </form>
                </div>
            </div>
        </div> 

                <?php endwhile;?>
            </tbody>
        
        </table>
        </div>
   
    <!-- modal tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required
                            >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Kelas:</label>
                            <select name="kelas" class="form-control" required>
                            <option disabled selected>== PILIH KELAS ==</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Jenis Kelamin:</label>
                            <select name="jk" class="form-control" required>
                            <option disabled selected>== jenis kelamin ==</option>
                                <option value="1">Laki-Laki</option>
                                <option value="0">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat:</label>
                           <textarea class="form-control" name="alamat" rows="2" placeholder="alamat lengkap" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
                </div>
                
                </form>
                </div>
            </div>
        </div> 

        














<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
</body>
</html>
<?php
include 'koneksi.php';

if(isset($_POST['submit'])){
    //insert 
    $insertSql =  mysqli_query($conn, "INSERT Into data (nama,kelas,tgl_lahir,jk,alamat) VALUES ('$_POST[nama]'
    ,'$_POST[kelas]','$_POST[tgl_lahir]','$_POST[jk]','$_POST[alamat]')");
    if ($insertSql){
        echo "<script type='text/javascript'>
        alert('data berhasil ditambah..!'); location.href=\"index.php\";
      </script>";
    }
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $querySql = $conn->query("DELETE FROM data WHERE id='$id'")or die(mysqli_error($conn));
    if($querySql){
        echo "<script>alert('data berhasil dihapus'); window.location.href='index.php';</script>";
    }
}

if(isset($_POST['edit'])){

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    $query =  $conn->query("UPDATE data  SET nama='$nama', kelas='$kelas', tgl_lahir='$tgl_lahir', jk='$jk', alamat='$alamat' ")or die(mysqli_error($conn));

    if ($query){
        echo "<script type='text/javascript'>
        alert('data berhasil diupdate..!'); location.href=\"index.php\";
      </script>";
    }
}

//upload file
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nama_file = $_FILES['fileupload']['name'];
    $tmp_nama = $_FILES['fileupload']['tmp_name'];

    $folder = "file/";

    $upload = move_uploaded_file($tmp_nama, $folder.$nama_file);

    if($upload){
        echo "<script type='text/javascript'>
        alert('File berhasil diupload..!'); location.href=\"index.php\";
      </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('File gagal diupload..!'); location.href=\"index.php\";
      </script>";
    }
}


?>