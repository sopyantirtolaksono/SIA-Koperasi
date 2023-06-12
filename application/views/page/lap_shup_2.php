<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan SHU Perorangan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
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
                <form method="get" action="<?= base_url('laporan-shu-perorangan-2') ?>">
                  <label>Periode Tahun</label>
                  <div class="input-group">
                    <select class="form-control" name="tahun">
                      <?php foreach ($tanggal as $tgl) : ?>
                        <?php
                        $tahun = explode('-', $tgl->pinjaman_waktu);
                        $tahun = $tahun[0];
                        ?>
                        <option value="<?= $tahun; ?>" <?= $tahun == date('Y') ? 'selected' : ''; ?>><?= $tahun; ?></option>
                      <?php endforeach; ?>
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
            <div class="table-responsive">
              <table class="table table-bordered mt-3" id="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Anggota</th>
                    <th>Nama Anggota</th>
                    <th>SHU Simpanan</th>
                    <th>SHU Pinjaman</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    $total_keseluruhan = 0;
                    foreach ($shu_perorangan as $shu_p) :
                      // shu_simpanan_perorangan = besar_simpanan / total_simpanan * 40% * jasa_shu_keseluruhan
                      $shu_simpanan = $shu_p['besar_simpanan'] / $total_simpanan * 40 / 100 * $shu_keseluruhan;

                      // shu_pinjaman_perorangan = besar_pinjaman / total_pinjaman * 15% * jasa_shu_keseluruhan
                      $shu_pinjaman = $shu_p['besar_pinjaman'] / $total_pinjaman * 15 / 100 * $shu_keseluruhan;

                      // total
                      $total = $shu_simpanan + $shu_pinjaman;
                      // total keseluruhan
                      $total_keseluruhan += $total;
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $shu_p['anggota_kode']; ?></td>
                      <td><?= $shu_p['anggota_nama']; ?></td>
                      <td>Rp. <?= number_format($shu_simpanan); ?></td>
                      <td>Rp. <?= number_format($shu_pinjaman); ?></td>
                      <td>Rp. <?= number_format($total); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="5" style="text-align: center;">Total Keseluruhan</th>
                    <th>Rp. <?= number_format($total_keseluruhan); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>