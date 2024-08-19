<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Mata Kuliah</h4>
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
        <a href="#">Data Umum</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Daftar Mata Kuliah</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">



            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Nama Matkul</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $matkul = mysqli_query($con, "SELECT * FROM tb_master_matkul");
                foreach ($matkul as $k) { ?>
                  <tr>
                    <td><?= $no++; ?>.</td>

                    <td><?= $k['kode_matkul']; ?></td>
                    <td><?= $k['matkul']; ?></td>
                    <td>

                      <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?= $k['id_matkul'] ?>"><i class="far fa-edit"></i> Edit</a>
                      <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=master&act=delmatkul&id=<?= $k['id_matkul'] ?>"><i class="fas fa-trash"></i> Del</a>

                      <!-- Modal -->
                      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $k['id_matkul'] ?>" class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Edit matkul</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <form action="" method="post">
                                <div class="row">
                                  <div class="col-md-10">
                                    <div class="form-group">
                                      <label>Nama Matkul</label>
                                      <input name="id" type="hidden" value="<?= $k['id_matkul'] ?>">
                                      <input name="matkul" type="text" value="<?= $k['matkul'] ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                      <button name="edit" class="btn btn-primary" type="submit">Edit</button>

                                    </div>
                                  </div>
                                </div>
                              </form>
                              <?php
                              if (isset($_POST['edit'])) {
                                $save = mysqli_query($con, "UPDATE tb_master_matkul SET matkul='$_POST[matkul]' WHERE id_matkul='$_POST[id]' ");
                                if ($save) {
                                  echo "<script>
                        alert('Data diubah !');
                        window.location='?page=master&act=matkul';
                        </script>";
                                }
                              }

                              ?>


                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->



                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="exampleModalLabel" class="modal-title">Tambah Matkul</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="form-horizontal">
          <div class="form-group">
            <label>Kode Matkul</label>
            <input name="kode" type="text" placeholder="Kode kelas .." class="form-control">
          </div>
          <div class="form-group">
            <label>Nama Matkul</label>
            <input name="matkul" type="text" placeholder="Nama matkul .." class="form-control">
          </div>


          <div class="form-group">
            <button name="save" class="btn btn-primary" type="submit">Save</button>
          </div>
        </form>
        <?php
        if (isset($_POST['save'])) {
          $save = mysqli_query($con, "INSERT INTO tb_master_matkul VALUES(NULL,'$_POST[kode]','$_POST[matkul]') ");
          if ($save) {
            echo "<script>
                        alert('Data tersimpan !');
                        window.location='?page=master&act=matkul';
                        </script>";
          }
        }

        ?>


      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->