<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Password</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Edit Password</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="<?= base_url('Dashboard/ganti_passwordAksi'); ?>">
          <div class="card">
            <div class="card-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" name="passbaru" class="form-control" required placeholder="Masukkan password baru">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" name="konfirmasipass" class="form-control" required placeholder="Konfirmasi password">
                </div>
              </div>
              <div class="col-md-12">
                <a href="#" class="btn btn-danger" onclick ="history.back(-1)">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>