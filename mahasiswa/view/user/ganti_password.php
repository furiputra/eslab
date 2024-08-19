<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $pass1 = sha1($_POST['pass1']); // Password Lama
    $pass2 = sha1($_POST['pass2']); // Password Baru
    $pass3 = sha1($_POST['pass3']); // Konfirmasi Password

    // Ambil password lama dari database
    $passLama = $data['password'];

    // Cek apakah password lama sesuai
    if ($pass1 === $passLama) {
        // Cek apakah password baru dan konfirmasi password sama
        if ($pass2 === $pass3) {
            // Update password di database
            $set = mysqli_query($con, "UPDATE tb_mahasiswa SET password='$pass2' WHERE id_mahasiswa='$data[id_mahasiswa]' ");
            if ($set) {
                echo "
                    <script type='text/javascript'>
                    setTimeout(function () {
                        swal('Berhasil', 'Password Berhasil Diubah', {
                            icon : 'success',
                            buttons: {                    
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
                    }, 10);
                    window.setTimeout(function(){ 
                        window.location.replace('?page=change');
                    }, 3000);
                    </script>";
            } else {
                echo "
                    <script type='text/javascript'>
                    setTimeout(function () {
                        swal('Gagal', 'Terjadi Kesalahan Saat Mengubah Password', {
                            icon : 'error',
                            buttons: {                    
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        });
                    }, 10);
                    window.setTimeout(function(){ 
                        window.location.replace('?page=change');
                    }, 3000);
                    </script>";
            }
        } else {
            echo "
                <script type='text/javascript'>
                setTimeout(function () {
                    swal('Gagal', 'Password Baru dan Konfirmasi Password Tidak Sesuai', {
                        icon : 'error',
                        buttons: {                    
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                }, 10);
                window.setTimeout(function(){ 
                    window.location.replace('?page=change');
                }, 3000);
                </script>";
        }
    } else {
        echo "
            <script type='text/javascript'>
            setTimeout(function () {
                swal('Gagal', 'Password Lama Tidak Cocok', {
                    icon : 'error',
                    buttons: {                    
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            }, 10);
            window.setTimeout(function(){ 
                window.location.replace('?page=change');
            }, 3000);
            </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <!-- Tambahkan link ke CSS dan JavaScript yang diperlukan -->
</head>

<body></body>
<div class="card card-profile">
    <div class="card-header" style="background-image: url('../assets/img/user/bguser.jpg')">
        <div class="profile-picture">
            <div class="avatar avatar-xl">
                <img src="../assets/img/user/<?= $data['foto']; ?>" alt="..." class="avatar-img rounded-circle">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="user-profile text-center">
            <div class="name"><?= $data['nama_mahasiswa'] ?></div>
            <div class="job"><?= $data['nis'] ?></div>

            <form action="" method="POST">
                <div class="form-group">
                    <input type="password" name="pass1" class="form-control" placeholder="Password Lama" required>
                </div>
                <div class="form-group">
                    <input type="password" name="pass2" class="form-control" placeholder="Password Baru" required>
                </div>
                <div class="form-group">
                    <input type="password" name="pass3" class="form-control" placeholder="Konfirmasi Password" required>
                </div>
                <div class="view-profile mt-3">
                    <button type="submit" class="btn btn-secondary btn-block">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>