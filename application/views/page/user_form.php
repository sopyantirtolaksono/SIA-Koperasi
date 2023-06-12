<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?=!empty($user)?'Edit':'Tambah'?> Data User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Master</div>
        <div class="breadcrumb-item"><?=!empty($user)?'Edit':'Tambah'?> Data User</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="">
          <div class="card">
            <div class="card-body row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="user_nama" value="<?=!empty($user)?$user->user_nama:''?>" required class="form-control" placeholder="Masukan nama lengkap" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="user_username" value="<?=!empty($user)?$user->user_username:''?>" required class="form-control" placeholder="Masukan username" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="user_password" <?=!empty($user)?'':'required placeholder="Masukan password"'?> <?=empty($user)?'':'placeholder="Masukan jika ingin mengubah"'?>  class="form-control" >
                </div>
              </div>
              <?php if (!empty($user)) :?>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control" name="user_level">
                    <option value="bendahara" <?= $user->user_level == 'bendahara' ? 'selected' :''; ?>>Bendahara</option>
                    <option value="pengawas" <?= $user->user_level == 'pengawas' ? 'selected' :''; ?>>Pengawas</option>
                    <option value="manager" <?= $user->user_level == 'manager' ? 'selected' :''; ?>>Manager</option>
                  </select>
                </div>
              </div>
              <?php else :  ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control" name="user_level">
                    <option value="bendahara">Bendahara</option>
                    <option value="pengawas">Pengawas</option>
                    <option value="manager">Manager</option>
                  </select>
                </div>
              </div>
            <?php endif; ?>

              <div class="col-md-12">
                <a href="<?=base_url('user')?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>