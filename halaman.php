<?php include("inc_header.php") ?>
<?php
$sukses="";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from halaman where id ='$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}
?>
<h1>Database</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Tambah Data Baru" />
    </a>
</p>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th ><center>No.<br></br></center></th>
            <th><center>Tanggal <br>(D/M/Y 00.00 UTC)</br></center></th>
            <th><center>Suhu <br>(°C)</br></center> </th>
            <th><center>Tekanan <br>(mb)</br></center></th>
            <th><center>Kelembaban <br>(%)</br></center></th>
            <th><center>Arah Angin <br>(°)<br></center></th>
            <th><center>Kecepatan Angin <br>(knot)</br></center></th>
            <th><center>Radiasi Matahari <br>(W/m^2)</br></center></th>
            <th><center>Curah Hujan <br>(mm)</br></center></th>
            <th class="col-1"><center>Aksi <br></br></center></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 2;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(suhu like '%" . $array_katakunci[$x] . "%'or tekanan like '%" . $array_katakunci[$x] . "%'or kelembaban like '%" . $array_katakunci[$x] . "%'or arahangin like '%" . $array_katakunci[$x] . "%'or kecepatanangin like '%" . $array_katakunci[$x] . "%' or radiasimatahari like '%" . $array_katakunci[$x] . "%'or curahhujan like '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan = "where" . implode("or", $sqlcari);
        }
        $sql1 = "select * from halaman $sqltambahan";
        $page = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1 = mysqli_query($koneksi,$sql1);
        $total = mysqli_num_rows($q1);
        $pages = ceil($total / $per_halaman);
        $nomor = $mulai + 1;
        $sql1 = $sql1." order by id desc limit $mulai,$per_halaman";

        $q1 = mysqli_query($koneksi, $sql1);
        
        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><center><?php echo $nomor++ ?></center></td>
                <td><center><?php echo $r1['tanggal'] ?></center></td>
                <td><center><?php echo $r1['suhu'] ?></center></td>
                <td><center><?php echo $r1['tekanan'] ?></center></td>
                <td><center><?php echo $r1['kelembaban'] ?></center></td>
                <td><center><?php echo $r1['arahangin'] ?></center></td>
                <td><center><?php echo $r1['kecepatanangin'] ?></center></td>
                <td><center><?php echo $r1['radiasimatahari'] ?></center></td>
                <td><center><?php echo $r1['curahhujan'] ?></center></td>
                <td>
                    <a href ="halaman_input.php?id=<?php echo $r1['id']?>">
                        <center><span class="badge bg-warning text-dark">Edit</span></center>
                    </a>
                    <a href="halaman.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Apakah yakin akan menghapus data?')">
                        <center><span class="badge bg-danger">Delete</span></center>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<nav aria-label ="Page Navigation example">
    <ul class="pagination">
        <?php
        $cari =(isset($_GET['cari']))? $_GET['cari'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
            <a class="page-link" href="halaman.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
            ?>
    </ul>

</nav>
<?php include("inc_footer.php") ?>