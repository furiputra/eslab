<?php 
$del = mysqli_query($con,"DELETE FROM tb_jadwal WHERE id_jadwal='$_GET[id]' ");
if ($del) {
		echo " <script>
		window.location='?page=jadwal_mahasiswa';
		</script>";	
}

 ?>