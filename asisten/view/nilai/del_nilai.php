<?php 
$del = mysqli_query($con,"DELETE FROM tb_nilai WHERE id_nilai=$_GET[id]");
if ($del) {
		echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=mahasiswa';
		</script>";	
}

 ?>