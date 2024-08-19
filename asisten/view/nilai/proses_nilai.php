<?php
					// Hubungkan ke database (pastikan koneksi sudah terbentuk sebelumnya)
					// Misalnya:
					// $con = mysqli_connect("localhost", "username", "password", "nama_database");

					if (isset($_POST['saveNilai'])) {
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