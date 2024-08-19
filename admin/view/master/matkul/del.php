<?php 
$del = mysqli_query($con,"DELETE FROM tb_master_matkul WHERE id_matkul=$_GET[id]");
if ($del) {
		echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=master&act=matkul';
		</script>";	
}

 ?>