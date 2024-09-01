<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dbsiswa";

$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
    echo "Database gagal terkoneksi";
}

$nisn = "";
$nama = "";
$jurusan = "";
$kelas = "";
$success ="";
$error  =""; 

if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op ="";
}

if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "select * from siswa where id = '$id'";
    $q1  = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nisn = $r1['nisn'];
    $nama = $r1['nama'];
    $jurusan = $r1['jurusan'];
    $kelas = $r1['kelas'];
    
    if($nisn == ''){
        $error = "data tidak di temukan";
    }
}

if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "delete from siswa where id='$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $success = "Berhasil Menghapus Data";
    }else{
        $error = "gagal melakukan delete";
    }
}

if(isset($_POST['simpan'])){
    $nisn  = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jurusan  = $_POST['jurusan'];
    $kelas  = $_POST['kelas'];
    if ($nisn && $nama && $jurusan && $kelas){
        if ($op == 'edit'){
            $sql1 = "update siswa set nisn = '$nisn',nama='$nama', jurusan='$jurusan',kelas='$kelas' where id='$id'";
            $q1= mysqli_query($koneksi,$sql1); 
            if($q1){
                $success = "Data Berhasil di Update";
            }else{
                $error = "data gagal di update";
            }
        }else{
             $sql1 = "insert into siswa (nisn,nama,jurusan,kelas) values ('$nisn', '$nama', '$jurusan', '$kelas')";
        $q1 = mysqli_query($koneksi, $sql1);
        if($q1){
            $success  = "berhasil memasukan data";
        }else {
            $error = "gagal memasukan data";
        }
        }
    }
    else{
        $error="silahkan masukan semua data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Crud Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 900px;
        }

        .card {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header bg-success fw-bolder">
                Create Data
            </div>
            <div class="card-body">
                <?php if ($error)
                {
                    ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                 </div>
                <?php
                header("refresh:4;url=index.php");
                }
                ?>
                  <?php if ($success)
                {
                    ?>
                    <div class="alert alert-success" role="alert">
                    <?php echo $success ?>
                 </div>
                <?php
                header("refresh:4;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row"><label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nisn" id="nisn"
                            value="<?php echo $nisn ?>">
                    </div>
                </div>
                    <div class="mb-3 row"><label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" id="nama"
                            value="<?php echo $nama ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select class="jurusan" name="jurusan" id="jurusan">
                            <option value="">--Pilih Jurusan--</option>
                            <option value="ak1" <?php if ($jurusan == "ak1")
                                echo "selected" ?>>Akutansi 1</option>
                                <option value="ak2" <?php if ($jurusan == "ak2")
                                echo "selected" ?>>Akutansi 2</option>
                                <option value="dkv1" <?php if ($jurusan == "dkv1")
                                echo "selected" ?>>Desain Komunikasi Visual
                                    1</option>
                                <option value="dkv2" <?php if ($jurusan == "dkv2")
                                echo "selected" ?>>Desain Komunikasi Visual
                                    2</option>
                                <option value="mp1" <?php if ($jurusan == "mp1")
                                echo "selected" ?>>Management Perkantoran 1
                                </option>
                                <option value="mp2" <?php if ($jurusan == "mp2")
                                echo "selected" ?>>Management Perkantoran 2
                                </option>
                                <option value="tm1" <?php if ($jurusan == "tm1")
                                echo "selected" ?>>Teknik Permesinan 1
                                </option>
                                <option value="tm2" <?php if ($jurusan == "tm2")
                                echo "selected" ?>>Teknik Permesinan 2
                                </option>
                                <option value="tkr" <?php if ($jurusan == "tkr")
                                echo "selected" ?>>Teknik Kendaraan Ringan
                                </option>
                                <option value="rpl" <?php if ($jurusan == "rpl")
                                echo "selected" ?>>Rekayasa Perangkat Lunak
                                </option>
                                <option value="pb" <?php if ($jurusan == "pb")
                                echo "selected" ?>>Perbankan Syariah</option>
                                <option value="kuliner" <?php if ($jurusan == "kuliner")
                                echo "selected" ?>>kuliner</option>
                                <option value="apat" <?php if ($jurusan == "apat")
                                echo "selected" ?>>Agribisnis Perikanan Air Tawar</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row"><label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kelas" id="kelas"
                                value="<?php echo $kelas ?>">
                    </div>
                </div>         
            </div>
            <div class="col-12">
                <input class="btn btn-success" type="submit" name="simpan" value="simpan data">
            </div>
            </form>
        </div>
<div class="card">
        <div class="card-header text-light bg-secondary">
            Data Siswa
        </div>
        <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nisn</th>
                            <th scope="col">nama</th>
                            <th scope="col">jurusan</th>
                            <th scope="col">kelas</th>
                            <th scope="col">aksi</th>
                        </tr>
                        <tbody>
                            <?php 
                            $sql2 = "select * from siswa order by id desc";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id = $r2 ['id'];
                                $nisn = $r2 ['nisn'];
                                $nama = $r2 ['nama'];
                                $jurusan = $r2 ['jurusan'];
                                $kelas = $r2 ['kelas'];

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++?></th>
                                    <td scope="row"><?php echo $nisn?></td>
                                    <td scope="row"><?php echo $nama?></td>
                                    <td scope="row"><?php echo $jurusan?></td>
                                    <td scope="row"><?php echo $kelas?></td>
                                    <td scope="row">
                                        <a href="index.php?op=edit&id=<?php echo $id?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                        
                                </a>
                                <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Apakah anda ingin menghapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                                <?php
                                 }
                                 ?>
                        </tbody>
                    </thead>
                </table>
        </div>
    </div>
        
    </div>

    
    </div>
</body>

</html>