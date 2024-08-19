<?php 
$del = mysqli_query($con,"DELETE FROM tb_kalab WHERE id_kalab=$_GET[id]");
if ($del) {
		echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=kalab';
		</script>";	
}

 ?>