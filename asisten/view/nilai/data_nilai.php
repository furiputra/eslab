<div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Nilai Praktikum</h4>
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
                <a href="#">Daftar Nilai Praktikum</a>
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
                              <th>LP 1</th>
                              <th>LP 2</th>
                              <th>LP 3</th>
                              <th>LP 4</th>
                              <th>UTS</th>
                              <th>UAS</th>
                              <th>Nilai Akhir</th>
                              <th>Opsi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $no=1;
                              $mahasiswa = mysqli_query($con,"SELECT * FROM tb_nilai 
                            INNER JOIN tb_master_matkul ON tb_nilai.id_matkul=tb_master_matkul.id_matkul
                            INNER JOIN tb_mkelas ON tb_nilai.id_mkelas=tb_mkelas.id_mkelas
                            WHERE tb_nilai.id_mahasiswa='$data[id_mahasiswa]'=1
                               ");
                              foreach ($mahasiswa as $d) {
                                // Menghitung total nilai
                                $total_nilai = $d['lp_1'] + $d['lp_2'] + $d['lp_3'] + $d['lp_4'] + $d['UTS'] + $d['UAS'];
                                // Menghitung rata-rata nilai
                                $rata_rata = $total_nilai / 6;
                            ?> 

                            <tr>
                              <th scope="row"><b><?=$no++; ?>.</b></th>
                              <td><?=$d['kode_matkul'] ?></td>
                              <td><?=$d['matkul'] ?></td>
                              <td><?=$d['jamke'] ?></td>
                              <td><?=$d['nama_kelas'] ?></td>
                              <td><?=$d['lp_1'] ?></td>
                              <td><?=$d['lp_2'] ?></td>
                              <td><?=$d['lp_3'] ?></td>
                              <td><?=$d['lp_4'] ?></td>
                              <td><?=$d['UTS'] ?></td>
                              <td><?=$d['UAS'] ?></td>
                              <td><?php echo $rata_rata; ?></td>
                              <td>
                              <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=nilai&act=del_nilai&pelajaran=<?=$g['id_nilai'] ?>"><i class="fas fa-trash"></i></a>
                            <a class="btn btn-info btn-sm" href="?page=nilai&act=edit_nilai&pelajaran=<?=$g['id_mahasiswa'] ?>"><i class="far fa-edit"></i></a>
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

 