<?php include("inc_header.php") ?>
<?php
$tanggal ="";
$suhu      = "";
$tekanan    = "";
$kelembaban        = "";
$arahangin        = "";
$kecepatanangin        = "";
$radiasimatahari        = "";
$curahhujan        = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id =$_GET['id'];
}else{
    $id ="";
}

if($id !=""){
    $sql1 ="select * from halaman where id='$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1 = mysqli_fetch_array($q1);
    $tanggal =$r1['tanggal'];
    $suhu = $r1['suhu'];
    $tekanan = $r1['tekanan'];
    $kelembaban = $r1['kelembaban'];
    $arahangin = $r1['arahangin'];
    $kecepatanangin = $r1['kecepatanangin'];
    $radiasimatahari = $r1['radiasimatahari'];
    $curahhujan = $r1['curahhujan'];

    if($suhu == ''){
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $suhu = $_POST['suhu'];
    $tekanan = $_POST['tekanan'];
    $kelembaban = $_POST['kelembaban'];
    $arahangin = $_POST['arahangin'];
    $kecepatanangin = $_POST['kecepatanangin'];
    $radiasimatahari = $_POST['radiasimatahari'];
    $curahhujan = $_POST['curahhujan'];

    if ($tanggal == '' or $suhu == '' or $tekanan == ''or $kelembaban == ''or $arahangin == ''or $kecepatanangin == ''or $radiasimatahari == ''or $curahhujan == '') {
        $error = "Silakan masukkan semua data.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1 = "update halaman set tanggal ='$tanggal',suhu ='$suhu',tekanan ='$tekanan',kelembaban='$kelembaban',arahangin='$arahangin',kecepatanangin='$kecepatanangin',radiasimatahari='$radiasimatahari',curahhujan='$curahhujan',tgl_isi=now() where id = '$id'";
        }else{
            $sql1 = "insert into halaman(tanggal,suhu,tekanan,kelembaban,arahangin,kecepatanangin,radiasimatahari,curahhujan) values('$tanggal','$suhu','$tekanan','$kelembaban','$arahangin','$kecepatanangin','$radiasimatahari','$curahhujan')";
        }
        
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Sukses memasukkan data";
        } else {
            $error = "Gagal memasukkan data";
        }
    }
}


?>
<h1>Input Data</h1>
<p>
    <a href="halaman.php">
        <input type="button" class="btn btn-primary" value="Kembali ke Database" />
    </a>
</p>
<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error?>
    </div>
<?php
}

?>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses?>
    </div>
<?php
}

?>
<form action="" method="post">
<div class="mb-3 row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal (D/M/Y 00.00 UTC)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tanggal" value="<?php echo $tanggal ?>" name="tanggal">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="suhu" class="col-sm-2 col-form-label">Suhu (°C)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="suhu" value="<?php echo $suhu ?>" name="suhu">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tekanan" class="col-sm-2 col-form-label">Tekanan (mb)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tekanan" value="<?php echo $tekanan ?>" name="tekanan">
        </div>
    </div>
    <div class="mb-3 row">
    <label for="kelembaban" class="col-sm-2 col-form-label">Kelembaban (%)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kelembaban" value="<?php echo $kelembaban ?>" name="kelembaban">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="arahangin" class="col-sm-2 col-form-label">Arah Angin (°)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="arahangin" value="<?php echo $arahangin ?>" name="arahangin">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kecepatanangin" class="col-sm-2 col-form-label">Kecepatan Angin (knot)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kecepatanangin" value="<?php echo $kecepatanangin ?>" name="kecepatanangin">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="radiasimatahari" class="col-sm-2 col-form-label">Radiasi Matahari (W/m^2)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="radiasimatahari" value="<?php echo $radiasimatahari ?>" name="radiasimatahari">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="curahhujan" class="col-sm-2 col-form-label">Curah Hujan (mm)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="curahhujan" value="<?php echo $curahhujan ?>" name="curahhujan">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>