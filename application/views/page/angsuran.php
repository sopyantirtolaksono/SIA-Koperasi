<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Angsuran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Data Angsuran</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col" width="3%">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Tempo</th>
                  <th scope="col">Total</th>
                  <th scope="col">Dibayar</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($data as $row) { 
                  $cek = $this->db->query(" SELECT SUM(angsuran_jumlah) as jml FROM angsuran 
                                            WHERE angsuran_pinjaman = '$row->pinjaman_kode' ")->row();
                  ?>
                <tr>
                  <td scope="row"><?=$no++?></td>
                  <td><?=ucwords($row->anggota_nama)?></td>              
                  <td><?=$row->pinjaman_tempo?> Bulan</td>
                  <td>Rp. <?=number_format($row->pinjaman_total)?></td>
                  <td>Rp. <?=number_format($cek->jml)?></td>
                  <td>                    
                    <a  href="<?=base_url('angsuran-detail/'.$row->pinjaman_kode)?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span> Detail</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>