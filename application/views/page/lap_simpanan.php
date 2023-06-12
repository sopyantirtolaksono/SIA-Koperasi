<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan Data Simpanan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan</div>
        <div class="breadcrumb-item">Data Anggota</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <button class="btn btn-primary" data-target="#print" data-toggle="modal"><i class="fas fa-print mr-2"></i>Cetak Data</button>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col" width="3%">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Wajib</th>
                  <th scope="col">Pokok</th>
                  <th scope="col">Sukarela</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($lsimpnan as $row) { 
                  $wajib    = $this->data->simpanan_anggota($row->anggota_kode,'wajib')->row();
                  $pokok    = $this->data->simpanan_anggota($row->anggota_kode,'pokok')->row();
                  $sukarela = $this->data->simpanan_anggota($row->anggota_kode,'sukarela')->row();
                  $total    = $this->data->simpanan_anggota($row->anggota_kode)->row();
                  ?>
                  <tr>
                    <td scope="row"><?=$no++?></td>
                    <td align="left"><?=ucwords($row->anggota_nama)?></td>
                    <td><?=isset($wajib->jumlah)?'Rp. '.number_format($wajib->jumlah):'Rp. 0'?></td>
                    <td><?=isset($pokok->jumlah)?'Rp. '.number_format($pokok->jumlah):'Rp. 0'?></td>
                    <td><?=isset($sukarela->jumlah)?'Rp. '.number_format($sukarela->jumlah):'Rp. 0'?></td>
                    <td><?=isset($total->jumlah)?'Rp. '.number_format($total->jumlah):'Rp. 0'?></td>
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

<div class="modal fade" id="print" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cetak Simpanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form target="_blank" method="get" action="<?=base_url('laporan-simpananp/cetak-periode')?>">
          <div class="form-group">
            <label for="tglawal">Tanggal Awal</label>
            <input type="date" name="awal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tglakhir">Tanggal Akhir</label>
            <input type="date" name="akhir" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Cetak Data</button>
            <a target="_blank" href="<?=base_url('laporan-simpanan/cetak')?>" class="btn btn-primary">Cetak Semua</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>