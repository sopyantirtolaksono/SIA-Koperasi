<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan SHU Perorangan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan</div>
        <div class="breadcrumb-item">SHU</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">            
            <!-- Print -->
            <div class="row">
              <div class="col-md-4">
                <form method="get" action="<?=base_url('laporan-shu-perorangan')?>">
                  <label>Periode Tahun</label>
                  <div class="input-group">
                    <select class="form-control" name="tahun">
                      <?php foreach ($tgl as $d ): ?>
                        
                        <?php 
                        $pecah = explode('-', $d->pinjaman_waktu);
                        $tahun = $pecah[0]; 
                        ?>
                        <option value="<?= $tahun; ?>" <?= $tahun == date('Y') ? 'selected' : ''; ?>><?= $tahun; ?></option>
                      <?php endforeach ?>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></a>
                    </div>
                  </form>
                </div>
                <div class="col-md-8">
                  <div class="float-right mt-4">
                    <a href="<?= $url_cetak; ?>" target="_blank" class="btn btn-primary btn-lg">
                      <i class="fas fa-print mr-2"></i>Cetak Data
                    </a>
                  </div>
                </div>
              </div>
              <div class="text-center mt-2">
                <h1>Koperasi</h1>
                <h5>Laporan SHU Perorangan</h5>
                <span>Periode Tahun : <?= empty($tahunp) ? $tahun : $tahunp ; ?></span>
              </div>            
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th>Anggota</th>
                    <th>Bagian Anggota</th>
                    <th>SHU Simpanan</th>
                    <th>Bagian Pengurus</th>
                    <th>Bagian Pegawai/Karyawan</th>
                    <th>Program Pembangunan Daerah Kerja</th>
                    <th>Program Sosial</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($data as $d ): ?>
                     <?php    
                    $bagAnggota     = ($d->pinjaman_total - $d->pinjaman_jumlah) * 25/100;
                    $cadangan       = ($d->pinjaman_total - $d->pinjaman_jumlah) * 30/100;
                    $bagPengurus    = ($d->pinjaman_total - $d->pinjaman_jumlah) * 15/100;
                    $bagPegawai     = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;
                    $programDaerah  = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;
                    $programSosial  = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;
                      
                    $shu = $bagAnggota + $cadangan + $bagPengurus + $bagPegawai + $programDaerah + $programSosial;
                    ?>
                    <tr>
                      <td><?= $d->anggota_nama; ?></td>
                      <td>Rp. <?= number_format($bagAnggota, 0, ',', '.'); ?></td>
                      <td>Rp. <?= number_format($cadangan, 0, ',', '.'); ?></td>
                      <td>Rp. <?= number_format($bagPengurus, 0, ',', '.'); ?></td>
                      <td>Rp. <?= number_format($bagPegawai, 0, ',', '.'); ?></td>
                      <td>Rp. <?= number_format($programDaerah, 0, ',', '.'); ?></td>
                      <td>Rp. <?= number_format($programSosial, 0, ',', '.'); ?></td>                      
                      <td>Rp. <?= number_format($shu, 0, ',', '.'); ?></td>
                    </tr>
                  <?php endforeach ?>  
                              
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>