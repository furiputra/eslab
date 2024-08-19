<?php
$taAktif = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_thajaran WHERE status=1 "));
$semAktif = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_semester WHERE status=1 "));

?>
<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Jadwal Mahasiswa</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="#">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Jadwal Mahasiswa</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Tambah Jadwal</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Elements</div>
				</div>
				<div class="card-body">
					<form action="" method="post">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="kode">Kode Matakuliah</label>
									<input name="kode" type="text" class="form-control" id="kode" placeholder="C31010">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Tahun Pelajaran</label>
									<input type="hidden" name="ta" value="<?= $taAktif['id_thajaran'] ?>">
									<input type="hidden" name="semester" value="<?= $semAktif['id_semester'] ?>">
									<input type="text" class="form-control" placeholder="<?= $taAktif['tahun_ajaran'] ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kode">Semester</label>
									<input type="text" class="form-control" placeholder="<?= $semAktif['semester'] ?>" readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Asisten Mata Pelajaran</label>
									<select name="asisten" class="form-control">
										<option value="">- Pilih -</option>
										<?php
										$asisten = mysqli_query($con, "SELECT * FROM tb_asisten ORDER BY id_asisten ASC");
										foreach ($asisten as $g) {
											echo "<option value='$g[id_asisten]'>$g[nama_asisten]</option>";
										}
										?>

									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Mahasiswa</label>
									<select name="mahasiswa" class="form-control">
										<option value="">- Pilih -</option>
										<?php
										$mahasiswa = mysqli_query($con, "SELECT * FROM tb_mahasiswa ORDER BY id_mahasiswa ASC");
										foreach ($mahasiswa as $g) {
											echo "<option value='$g[id_mahasiswa]'>$g[nama_mahasiswa]</option>";
										}
										?>

									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Mata Pelajaran</label>
									<select name="matkul" class="form-control">
										<option value="">- Pilih -</option>
										<?php
										$matkul = mysqli_query($con, "SELECT * FROM tb_master_matkul ORDER BY id_matkul ASC");
										foreach ($matkul as $g) {
											echo "<option value='$g[id_matkul]'>[ $g[kode_matkul] ] $g[matkul]</option>";
										}
										?>

									</select>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="form-check">
									<label>Hari</label><br />
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Senin">
										<span class="form-radio-sign">Senin</span>
									</label>
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Selasa">
										<span class="form-radio-sign">Selasa</span>
									</label>
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Rabu">
										<span class="form-radio-sign">Rabu</span>
									</label>
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Kamis">
										<span class="form-radio-sign">Kamis</span>
									</label>
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Jum'at">
										<span class="form-radio-sign">Jum'at</span>
									</label>
									<label class="form-radio-label">
										<input class="form-radio-input" type="radio" name="hari" value="Sabtu">
										<span class="form-radio-sign">Sabtu</span>
									</label>

								</div>
							</div>
							<div class="col-md-6">
								<label>Kelas</label>
								<select name="kelas" class="form-control">
									<option value="">- Pilih -</option>
									<?php
									$kelas = mysqli_query($con, "SELECT * FROM tb_mkelas ORDER BY id_mkelas ASC");
									foreach ($kelas as $g) {
										echo "<option value='$g[id_mkelas]'>$g[nama_kelas]</option>";
									}
									?>

								</select>


							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="waktu">Waktu</label>
									<input name="waktu" type="text" class="form-control" id="waktu" placeholder="00.00 - 00.00">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="jamke">Jam Ke</label>
									<input name="jamke" type="text" class="form-control" id="jamke" placeholder="1 - 10">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" name="save" class="btn btn-secondary">
										<i class="far fa-save"></i> Simpan
									</button>
									<a href="javascript:history.back()" class="btn btn-danger">
										<i class="fas fa-angle-double-left"></i> Kembali
									</a>
								</div>
							</div>
						</div>
					</form>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$kode = $_POST['kode'];
						$ta = $_POST['ta'];
						$semester = $_POST['semester'];
						$asisten = $_POST['asisten'];
						$matkul = $_POST['matkul'];
						$hari = $_POST['hari'];
						$kelas = $_POST['kelas'];
						$waktu = $_POST['waktu'];
						$jamke = $_POST['jamke'];
						$mahasiswa = $_POST['mahasiswa'];

						// Query untuk memasukkan data ke dalam tabel tb_jadwal
						$query = "INSERT INTO tb_jadwal (kode_matkul, id_thajaran, id_semester, id_asisten, id_matkul, id_mkelas, hari, jam_mengajar, jamke, id_mahasiswa) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

						// Gunakan prepared statements untuk menghindari kesalahan sintaks dan SQL injection
						$stmt = mysqli_prepare($con, $query);
						mysqli_stmt_bind_param($stmt, "siiissssii", $kode, $ta, $semester, $asisten, $matkul, $kelas, $hari, $waktu, $jamke, $mahasiswa);


						// Eksekusi statement
						if (mysqli_stmt_execute($stmt)) {
							echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('Sukses', 'Jadwal berhasil ditambahkan', {
                icon : 'success',
                buttons: {        			
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });    
        }, 10);  
        window.setTimeout(function(){ 
            window.location.replace('?page=jadwal_mahasiswa');
        }, 3000);   
        </script>";
						} else {
							echo "Error: " . mysqli_error($con); // Tampilkan pesan error untuk debugging
						}

						// Tutup statement
						mysqli_stmt_close($stmt);
					}
					?>





				</div>

			</div>
		</div>
	</div>
</div>
</div>