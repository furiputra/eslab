<?php
@session_start();
include '../controller/db.php';

if (!isset($_SESSION['mahasiswa'])) {
?> <script>
		alert('Maaf ! Anda Belum Login !!');
		window.location = '../user.php';
	</script>
<?php
}
?>


<?php
$id_login = @$_SESSION['mahasiswa'];
$sql = mysqli_query($con, "SELECT * FROM tb_mahasiswa
	INNER JOIN tb_mkelas ON tb_mahasiswa.id_mkelas=tb_mkelas.id_mkelas
 WHERE tb_mahasiswa.id_mahasiswa = '$id_login'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

// tampilkan data jadwal
$mahasiswa = mysqli_query($con, "SELECT * FROM tb_jadwal 

INNER JOIN tb_master_matkul ON tb_jadwal.id_matkul=tb_master_matkul.id_matkul
INNER JOIN tb_mkelas ON tb_jadwal.id_mkelas=tb_mkelas.id_mkelas

INNER JOIN tb_semester ON tb_jadwal.id_semester=tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_jadwal.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_jadwal.id_mahasiswa='$data[id_mahasiswa]' AND tb_thajaran.status=1 ");


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Mahasiswa | Aplikasi Presensi</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.php" class="logo">
					<!-- <img src="../assets/img/mts.png" alt="navbar brand" class="navbar-brand" width="40"> -->
					<b class="text-white">Menu Mahasiswa</b>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<!-- 	<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div> -->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<!-- <li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li> -->



						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/user/<?= $data['foto'] ?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/user/<?= $data['foto'] ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= $data['nama_mahasiswa'] ?></h4>
												<p class="text-muted"><?= $data['nip'] ?></p>
												<!-- <a href="?page=jadwal" class="btn btn-xs btn-secondary btn-sm">Jadwal Mengajar</a> -->
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="?page=change">Ganti Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/user/<?= $data['foto'] ?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?= $data['nama_mahasiswa'] ?>

								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="?page=change">
											<span class="link-collapse">Ganti Password</span>
										</a>
									</li>

								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="index.php" class="collapsed">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Main Utama</h4>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-clipboard-check"></i>
								<p>Presensi</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<?php foreach ($mahasiswa as $dm) { ?>
										<li>
											<a href="?page=kehadiran&act=&kehadiran=<?= $dm['id_jadwal'] ?>">
												<span class="sub-item"><!-- <?= strtoupper($dm['matkul']); ?> -->KELAS (<?= strtoupper($dm['nama_kelas']); ?>)</span>
											</a>
										</li>
									<?php } ?>
								</ul>
							</div>
						</li>


						<li class="nav-item">
							<a href="?page=upload">
								<i class="fas fa-clipboard-list"></i>
								<p>Jadwal Praktikum</p>
							</a>

						</li>

						<li class="nav-item">
							<a href="?page=view">
								<i class="fas fa-user-tie"></i>
								<p>Nilai Praktikum</p>
							</a>

						</li>

						<li class="nav-item active mt-3">
							<a href="logout.php" class="collapsed">
								<i class="fas fa-arrow-alt-circle-left"></i>
								<p>Logout</p>
							</a>
						</li>

						<!-- 
						<li class="mx-4 mt-2">
							<a href="logout.php" class="btn btn-primary btn-block"><span class="btn-label"> <i class="fas fa-arrow-alt-circle-left"></i> </span> Logout</a> 
						</li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">

				<!-- Halaman dinamis -->
				<?php
				error_reporting();
				$page = @$_GET['page'];
				$act = @$_GET['act'];

				if ($page == 'izin') {
					if ($act == '') {
						include 'view/izin/ajukan_izin.php';
					} elseif ($act == 'surat_view') {
						include 'view/izin/view_surat_izin.php';
					}
				} elseif ($page == 'kehadiran') {
					if ($act == '') {
						include 'view/absen/kehadiran.php';
					}
				} elseif ($page == 'upload') {
					if ($act == '') {
						include 'view/jadwal/jadwal_prak.php';
					}
				} elseif ($page == 'view') {
					if ($act == '') {
						include 'view/nilai/nilai_prak.php';
					}
				} elseif ($page == 'change') {
					include 'view/user/ganti_password.php';
				} elseif ($page == '') {
					include 'view/home.php';
				} else {
					echo "<b>Tidak ada Halaman</b>";
				}


				?>


				<!-- end -->

			</div>
			<footer class="footer">
				<div class="container">
					<div class="copyright ml-auto">
						&copy; <?php echo date('Y'); ?> Absensi Embedded System Laboratory (<a href="index.php">IT-PLN </a> | 2024)
					</div>
				</div>
			</footer>
		</div>


	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>



	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>


</body>

</html>