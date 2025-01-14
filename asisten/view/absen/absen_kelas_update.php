<?php
// tampilkan data mengajar
$kelasMengajar = mysqli_query($con, "SELECT * FROM tb_mengajar 

INNER JOIN tb_master_matkul ON tb_mengajar.id_matkul=tb_master_matkul.id_matkul
INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas

INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_mengajar.id_asisten='$data[id_asisten]' AND tb_mengajar.id_mengajar='$_GET[pelajaran]'  AND tb_thajaran.status=1  ");

foreach ($kelasMengajar as $d)
?>
<!-- 
<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						
					</div>
				</div> -->
<div class="page-inner">

    <div class="page-header">
        <!-- <h4 class="page-title">KELAS (<?= strtoupper($d['nama_kelas']) ?> )</h4> -->
        <ul class="breadcrumbs" style="font-weight: bold;">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">KELAS (<?= strtoupper($d['nama_kelas']) ?> )</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?= strtoupper($d['matkul']) ?></a>
            </li>
        </ul>

    </div>
    <div class="row">

        <div class="col-md-8 col-xs-12">
            <?php
            // tampilkan jika da yg izin hari ini
            // tampilkan sataurs izin
            $today = date('Y-m-d'); // tanggal sekarang
            $queryIzin = mysqli_query($con, "SELECT * FROM tb_mahasiswa 

								WHERE  tb_mahasiswa.id_mkelas=" . $d['id_mkelas']);
            foreach ($queryIzin as $si) { ?>

            <?php } ?>

            <?php
            // dapatkan pertemuan terakhir di tb izin
            $last_pertemuan = mysqli_query($con, "SELECT * FROM _logabsensi WHERE id_mengajar='$_GET[pelajaran]' GROUP BY pertemuan_ke ORDER BY pertemuan_ke DESC LIMIT 1  ");
            $cekPertemuan = mysqli_num_rows($last_pertemuan);
            $jml = mysqli_fetch_array($last_pertemuan);

            if ($cekPertemuan > 0) {
                $pertemuan = $jml['pertemuan_ke'] + 1;
            } else {
                $pertemuan = 1;
            }
            ?>

            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <!-- <div class="card-title fw-mediumbold">DAFTAR HADIR mahasiswa</div> -->
                        <!-- 			<p>
									<span class="badge badge-default" style="padding: 7px;font-size: 14px;"><b>Daftar Hadir mahasiswa</b>
									</span>
									<span class="badge badge-primary" style="padding: 7px;font-size: 14px;">
									Pertemuan Ke : <b><?= $pertemuan; ?></b>
									</span>
									</p> -->
                        <!-- <input type="date" name="tgl" class="form-control" value="<?= date('Y-m-d') ?>" style="background-color: #212121;color: #FFEB3B;">	 -->
                        <input type="hidden" name="pertemuan" class="form-control" value="<?= $pertemuan; ?>">
                        <input type="hidden" name="pelajaran" value="<?= $_GET['pelajaran'] ?>">

                        <table>
                            <?php

                            // tampilakan data mahasiswa berdasarkan kelas yang dipilih
                            $tgl_hari_ini = date('Y-m-d');

                            $mahasiswa = mysqli_query($con, "SELECT * FROM _logabsensi INNER JOIN tb_mahasiswa ON _logabsensi.id_mahasiswa=tb_mahasiswa.id_mahasiswa WHERE  _logabsensi.tgl_absen='$tgl_hari_ini' AND _logabsensi.id_mengajar='$_GET[pelajaran]' ORDER BY _logabsensi.id_mahasiswa ASC  ");
                            $jumlahMahasiswa = mysqli_num_rows($mahasiswa);

                            foreach ($mahasiswa as $i => $s) { ?>
                                <tr>
                                    <td>
                                        <b class="text-success"><?= $s['nama_mahasiswa']; ?></b>
                                        <?php if ($s['ket'] == '') {

                                            echo "<span class='text-danger'>Belum Absen</span>";
                                        } ?>
                                        <input type="hidden" name="id_mahasiswa-<?= $i; ?>" value="<?= $s['id_mahasiswa'] ?>">
                                        <div class="form-check">

                                            <label class="form-check-label">
                                                <input name="ket-<?= $i; ?>" class="form-check-input" type="checkbox" value="H" <?php if ($s['ket'] == 'H') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                <span class="form-check-sign">H</span>
                                            </label>

                                            <label class="form-check-label">
                                                <input name="ket-<?= $i; ?>" class="form-check-input" type="checkbox" value="I" <?php if ($s['ket'] == 'I') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                <span class="form-check-sign">I</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input name="ket-<?= $i; ?>" class="form-check-input" type="checkbox" value="S" <?php if ($s['ket'] == 'S') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                <span class="form-check-sign">S</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input name="ket-<?= $i; ?>" class="form-check-input" type="checkbox" value="A" <?php if ($s['ket'] == 'A') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                <span class="form-check-sign">A</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>

                </div>
                <!-- <input type="submit" name="absen" class="btn btn-info"> -->
                <center>
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="fa fa-check"></i> Update Absensi
                    </button>

                    <a href="javascript:history.back()" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i>
                        Kembali</a>

                </center>
            </div>
            </form>

            <?php
            if (isset($_POST['update'])) {

                $total = $jumlahMahasiswa - 1;


                for ($i = 0; $i <= $total; $i++) {

                    $pertemuan = $_POST['pertemuan'];
                    $hari_sekarang = date('Y-m-d');

                    $id_mahasiswa = $_POST['id_mahasiswa-' . $i];
                    $pelajaran = $_POST['pelajaran'];
                    $ket = $_POST['ket-' . $i];

                    echo "<pre>";
                    print_r($_POST);
                    echo "</pre>";

                    $updte_absen = mysqli_query($con, "UPDATE _logabsensi SET ket='$ket' WHERE id_mengajar='$pelajaran' AND id_mahasiswa='$id_mahasiswa' AND tgl_absen='$hari_sekarang' ");

                    if ($updte_absen) {


                        echo "
											<script type='text/javascript'>
											setTimeout(function () { 

											swal('Berhasil', 'Absensi Telah berubah', {
											icon : 'success',
											buttons: {        			
											confirm: {
											className : 'btn btn-success'
											}
											},
											});    
											},10);  
											window.setTimeout(function(){ 
											window.location.replace('?page=absen&act=update&pelajaran=$_GET[pelajaran]');
											} ,3000);   
											</script>";
                    }
                }
            }

            ?>

        </div>
        <!-- <center>
<span class="alert alert-success">
<i class="text-primary">H : (Hadir)</i>
<i class="text-info">I : (Izin)</i>
<i class="text-warning">S : (Sakit)</i>
<i class="text-danger">A : (Alfa)</i>
</span>
</center> -->
    </div>

</div>

</div>