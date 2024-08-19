<?php
include '../../../controller/db.php';

?>

<?php
$bulan = $_GET['bulan'];
// tampilkan data mengajar
$kelasMengajar = mysqli_query($con, "SELECT * FROM tb_mengajar 
	INNER JOIN tb_asisten ON tb_mengajar.id_asisten=tb_asisten.id_asisten

INNER JOIN tb_master_matkul ON tb_mengajar.id_matkul=tb_master_matkul.id_matkul
INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas

INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_mengajar.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1  ");

foreach ($kelasMengajar as $d)




	// tampilkan data absen

	$qry = mysqli_query($con, "SELECT * FROM _logabsensi 
		INNER JOIN tb_mahasiswa ON _logabsensi.id_mahasiswa=tb_mahasiswa.id_mahasiswa
		INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
		WHERE MONTH(tgl_absen)='$bulan' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1
	 GROUP BY _logabsensi.id_mahasiswa  ORDER BY _logabsensi.id_mahasiswa ASC ");
foreach ($qry as $db)


	$tglBulan = $db['tgl_absen'];
$tglTerakhir = date('t', strtotime($tglBulan));


?>
<style>
	body {
		font-family: arial;
	}
</style>
<table width="100%">
	<tr>
		<td>
			<center>

				<h1>
					ABSESNSI MAHASISWA <br>
					<small> Embedded System Laboratory</small>
				</h1>
				<hr>
				<em>
					Menara PLN lantai 3, Jl. Lkr. Luar Barat, RT.1/RW.1, Duri Kosambi, Kec. Cengkareng, Kota Jakarta Barat, DKI Jakarta<br> Kode Pos (11750) <br>
					<b>Email : embeddedsystemlab@itpln.ac.id Telp.085156131965</b>
				</em>

			</center>
		</td>
		<td>

			<table width="100%">
				<tr>
					<td colspan="2"><b style="border: 2px solid;padding: -5px;">
							KELAS ( <?= strtoupper($d['nama_kelas']) ?> )
						</b> </td>
					<td>
						<b style="border: 2px solid;padding: 7px;">
							<?= $d['semester'] ?> |
							<?= $d['tahun_ajaran'] ?>
						</b>
					</td>
					<td rowspan="5">
						<ul>
							<li>H= Hadir</li>
							<li>S = Sakit</li>
							<li>I = Izin</li>
							<li>A = Absen</li>
						</ul>
						<!-- <p>H= Hadir</p>
<p>I = Izin</p>
<p>S = Sakit</p>
<p>A = Absesn    </p> -->
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Nama Asisten </td>
					<td>:</td>
					<td><?= $d['nama_asisten'] ?></td>
				</tr>
				<tr>
					<td>Bidang Studi </td>
					<td>:</td>
					<td><?= $d['matkul'] ?></td>
				</tr>

			</table>
		</td>
	</tr>
</table>

<hr style="height: 3px;border: 1px solid;">


<table width="100%" border="1" cellpadding="2" style="border-collapse: collapse;">
	<tr>
		<td rowspan="2" bgcolor="#EFEBE9" align="center">NO</td>
		<td rowspan="2" bgcolor="#EFEBE9">NAMA MAHASISWA</td>
		<td rowspan="2" bgcolor="#EFEBE9" align="center">L/P</td>
		<td colspan="<?= $tglTerakhir; ?>" style="padding: 8px;">PERTEMUAN BULAN : <b style="text-transform: uppercase;"><?php echo namaBulan($bulan); ?> <?= date('Y', strtotime($tglBulan)); ?></b></td>
		<td colspan="5" align="center" bgcolor="#EFEBE9">JUMLAH</td>
	</tr>
	<tr>
		<?php
		for ($i = 1; $i <= $tglTerakhir; $i++) {
			echo "<td bgcolor='#EFEBE9' align='center'>" . $i . "</td>";
		}


		?>
		<td bgcolor="#FFC107" align="center">S</td>
		<td bgcolor="#4CAF50" align="center">I</td>
		<td bgcolor="#D50000" align="center">A</td>

	</tr>
	<?php
	// tampilkan absen mahasiswa
	$no = 1;
	foreach ($qry as $ds) {
		$warna = ($no % 2 == 1) ? "#ffffff" : "#f0f0f0";

	?>
		<tr>

		<tr bgcolor="<?= $warna; ?>">
			<td align="center"><?= $no++; ?></td>
			<td><?= $ds['nama_mahasiswa']; ?></td>
			<td align="center"><?= $ds['jk']; ?></td>
			<?php
			for ($i = 1; $i <= $tglTerakhir; $i++) {


			?>
				<td align="center" bgcolor="white">
					<?php
					$ket = mysqli_query($con, "SELECT * FROM _logabsensi
		INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
		WHERE DAY(tgl_absen)='$i' AND id_mahasiswa='$ds[id_mahasiswa]' AND _logabsensi.id_mengajar='$_GET[pelajaran]' AND MONTH(tgl_absen)='$bulan' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 GROUP BY DAY(tgl_absen) ");
					foreach ($ket as $h)

						// echo $h['ket'];
						if ($h['ket'] == 'H') {
							echo "<b style='color:#2196F3;'>H</b>";
						} elseif ($h['ket'] == 'I') {
							echo "<b style='color:#4CAF50;'>I</b>";
						} elseif ($h['ket'] == 'S') {
							echo "<b style='color:#FFC107;'>S</b>";
						} elseif ($h['ket'] == 'A') {
							echo "<b style='color:#D50000;'>A</b>";
						}




					?>
				</td>

			<?php


			}

			?>
			<td align="center" style="font-weight: bold;">
				<?php
				$sakit = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(ket) AS sakit FROM _logabsensi
	INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
 WHERE _logabsensi.id_mahasiswa='$ds[id_mahasiswa]' and _logabsensi.ket='S' and MONTH(tgl_absen)='$bulan' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
				echo $sakit['sakit'];

				?>
			</td>
			<td align="center" style="font-weight: bold;">
				<?php
				$izin = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(ket) AS izin FROM _logabsensi
	INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
 WHERE _logabsensi.id_mahasiswa='$ds[id_mahasiswa]' and _logabsensi.ket='I' and MONTH(tgl_absen)='$bulan' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
				echo $izin['izin'];

				?>
			</td align="center" style="font-weight: bold;">
			<td align="center" style="font-weight: bold;">
				<?php
				$alfa = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(ket) AS alfa FROM _logabsensi
	INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
		INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
		INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
 WHERE _logabsensi.id_mahasiswa='$ds[id_mahasiswa]' and _logabsensi.ket='A' and MONTH(tgl_absen)='$bulan' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
				echo $alfa['alfa'];

				?>
			</td>

		</tr>
	<?php } ?>
</table>

<p></p>
<table width="100%">
	<tr>
		<!-- 	<td align="left">
			<p>
				Mengetahui
			</p>
			<p>
				Kepala Sekolah
				<br>
				<br>
				<br>
				<br>
				<br>
				-----------------------------
			</p>
		</td> -->
		<td align="right">
			<p>
				Jakarta, <?php echo date('d-F-Y'); ?>
			</p>
			<p>
				Kepala Laboratorium
				<br>
				<br>
				<br>
				<br>
				<br>
				Karina Djunaidi, ST.,MTI <br>
				----------------------<br>
				NIP.1989201509A
			</p>
		</td>
	</tr>
</table>

<script>
	window.print();
</script>