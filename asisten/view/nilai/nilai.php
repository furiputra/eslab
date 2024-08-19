<?php

?>
<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Nilai</h4>
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
				<a href="#">Nilai Praktikum</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Tambah Nilai</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Nilai Praktikum</div>
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

							<div class="row">
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

							<div class="status mt-0">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="lp_1">Nilai Lap 1:</label>
										<input name="lp_1" type="text" class="form-control" id="lp_1" placeholder="lp_1">
									</div>
									<div class="form-group row">
										<div class="col-md-4">
											<label for="lp_2">Nilai Lap 2:</label>
											<input name="lp_2" type="text" class="form-control" id="lp_2" placeholder="lp_2">
										</div>
										<div class="form-group row">
											<div class="col-md-4">
												<label for="lp_3">Nilai Lap 3:</label>
												<input name="lp_3" type="text" class="form-control" id="lp_3" placeholder="lp_3">
											</div>
											<div class="form-group row">
												<div class="col-md-4">
													<label for="lp_4">Nilai Lap 4:</label>
													<input name="lp_4" type="text" class="form-control" id="lp_4" placeholder="lp_4">
												</div>
												<div class="form-group row">
													<div class="col-md-4">
														<label for="UTS">UTS:</label>
														<input name="UTS" type="text" class="form-control" id="UTS" placeholder="UTS">
													</div>
													<div class="form-group row">
														<div class="col-md-6">
															<label for="UAS">UAS:</label>
															<input name="UAS" type="text" class="form-control" id="UAS" placeholder="UAS">
														</div>
													</div>
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
					// Hubungkan ke database (pastikan koneksi sudah terbentuk sebelumnya)
					// Misalnya:
					// $con = mysqli_connect("localhost", "username", "password", "nama_database");

					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						// Ambil nilai dari form
						$kode_matkul = $_POST['kode'];
						$id_matkul = $_POST['matkul'];
						$jamke = $_POST['jamke'];
						$id_mkelas = $_POST['kelas'];
						$lp_1 = $_POST['lp_1'];
						$lp_2 = $_POST['lp_2'];
						$lp_3 = $_POST['lp_3'];
						$lp_4 = $_POST['lp_4'];
						$UTS = $_POST['UTS'];
						$UAS = $_POST['UAS'];
						$id_mahasiswa = $_POST['mahasiswa'];

						// Query untuk insert data ke tabel tb_nilai
						$query = "INSERT INTO tb_nilai (kode_matkul, id_matkul, jamke, id_mkelas, lp_1, lp_2, lp_3, lp_4, UTS, UAS, id_mahasiswa) 
              VALUES ('$kode_matkul', '$id_matkul', '$jamke', '$id_mkelas', '$lp_1', '$lp_2', '$lp_3', '$lp_4', '$UTS', '$UAS', '$id_mahasiswa')";

						// Eksekusi query
						$result = mysqli_query($con, $query);


						if ($insert) {
							echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('Sukses', 'Nilai praktikum berhasil ditambahkan', {
                icon : 'success',
                buttons: {        			
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });    
        }, 10);  
        window.setTimeout(function(){ 
            window.location.replace('?page=niali');
        }, 3000);   
        </script>";
						} 
					}
					?>




				</div>

			</div>
		</div>
	</div>
</div>
</div>