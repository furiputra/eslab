<div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Jadwal Praktikum</h4>
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
                <a href="#">Jadwal Praktikum</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Daftar Jadwal Praktikum</a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                    <div class="card-body">
                      <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Kode MK</th>
                              <th>Mata Kuliah</th>
                              <th>SKS</th>
                              <th>Kelas</th>
                              <th>Hari</th>
                              <th>Jam</th>
                              <th>Asisten</th>
                              <th>Kehadiran</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $no=1;
                              $mahasiswa = mysqli_query($con,"SELECT * FROM tb_jadwal 
                            INNER JOIN tb_asisten ON tb_jadwal.id_asisten=tb_asisten.id_asisten
                            INNER JOIN tb_master_matkul ON tb_jadwal.id_matkul=tb_master_matkul.id_matkul
                            INNER JOIN tb_mkelas ON tb_jadwal.id_mkelas=tb_mkelas.id_mkelas

                            INNER JOIN tb_semester ON tb_jadwal.id_semester=tb_semester.id_semester
                            INNER JOIN tb_thajaran ON tb_jadwal.id_thajaran=tb_thajaran.id_thajaran 
                            WHERE tb_jadwal.id_mahasiswa='$data[id_mahasiswa]'=1
                               ");
                              foreach ($mahasiswa as $d) {
                             ?>

                            <tr>
                              <th scope="row"><b><?=$no++; ?>.</b></th>
                              <td><?=$d['kode_matkul'] ?></td>
                              <td><?=$d['matkul'] ?></td>
                              <td><?=$d['jamke'] ?></td>
                              <td><?=$d['nama_kelas'] ?></td>
                              <td><?=$d['hari'] ?></td>
                              <td><?=$d['jam_mengajar'] ?></td>
                              <td><?=$d['nama_asisten'] ?></td>
                          
                              <td>
                                <a href="?page=kehadiran&act=&kehadiran=<?=$d['id_jadwal'];?>" class="btn btn-success btn-sm"> Presensi</a>

                                <!-- <a  href="?page=nilai&matkul=<?=$d['id_pelajaran'];?>" class="btn btn-success btn-sm"><i class="fas fa-file-contract"></i> Lihat Absen</a> -->
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

 