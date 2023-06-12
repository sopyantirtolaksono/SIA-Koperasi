<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Informasi Koperasi</title>
  <link rel="icon" type="image/x-icon" href="<?=base_url('src/img/logo.png')?>">
  <meta name="description" content="Sistem informasi koperasi ini merupakan sistem yang digunakan untuk mempermudah pelayanan dan pendataan koperasi simpan pinjam.">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url('src/')?>css/jqvmap.min.css">
  <link rel="stylesheet" href="<?=base_url('src/')?>css/summernote-bs4.css">
  <link rel="stylesheet" href="<?=base_url('src/')?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?=base_url('src/')?>css/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url('src/')?>css/style.css">
  <link rel="stylesheet" href="<?=base_url('src/')?>css/components.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, <?=ucwords($this->session->userdata('nama'))?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged as <?=ucwords($this->session->userdata('level'))?></div>
              <a onclick="return logout('<?=base_url('auth/logout')?>')" href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?=base_url('dashboard')?>" style="font-size: 16pt">Koperasi</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?=base_url('dashboard')?>"><img alt="image" src="<?=base_url('src/img/logo.png')?>" style="width: 30px"></a>
          </div>
          <ul class="sidebar-menu">
            <?php if ($this->session->userdata('level') == 'bendahara') : ?>
              <li class="<?=isset($home)?'active':''?>"><a class="nav-link" href="<?=base_url('dashboard')?>"><i class="fas fa-home"></i> <span>Home</span></a></li>

              <li class="menu-header">Main menu :</li>

              <li class="nav-item dropdown <?=isset($master)?'active':''?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Data Master</span></a>
                <ul class="dropdown-menu">
                  <li class="<?=isset($anggota)?'active':''?>"><a class="nav-link" href="<?=base_url('anggota')?>">Data Anggota</a></li>
                  <li class="<?=isset($user)?'active':''?>"><a class="nav-link" href="<?=base_url('user')?>">Data User</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown <?=isset($simpan)?'active':''?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-pdf"></i> <span>Data Simpanan</span></a>
                <ul class="dropdown-menu">
                  <li class="<?=isset($jenis) && $jenis == 'wajib'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-wajib')?>">Simpanan Wajib</a></li>
                  <li class="<?=isset($jenis) && $jenis == 'sukarela'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-sukarela')?>">Simpanan Sukarela</a></li>
                  <li class="<?=isset($jenis) && $jenis == 'pokok'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-pokok')?>">Simpanan Pokok</a></li>
                </ul>
              </li>


              <li class="<?=isset($pinjaman)?'active':''?>"><a class="nav-link" href="<?=base_url('pinjaman')?>"><i class="fas fa-file"></i> <span>Pinjaman</span></a></li>
              <li class="<?=isset($angsuran)?'active':''?>"><a class="nav-link" href="<?=base_url('angsuran')?>"><i class="fas fa-history"></i> <span>Angsuran Pinjaman</span></a></li>
              <li class="<?=isset($penarikan)?'active':''?>"><a class="nav-link" href="<?=base_url('penarikan')?>"><i class="fas fa-money-bill"></i> <span>Penarikan</span></a></li>

              <li class="nav-item dropdown <?=isset($mneraca)?'active':''?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Data Neraca</span></a>
                <ul class="dropdown-menu">
                  <li class="<?=isset($akun)?'active':''?>"><a class="nav-link" href="<?=base_url('akun')?>">Akun</a></li>
                  <li class="<?=isset($neraca)?'active':''?>"><a class="nav-link" href="<?=base_url('neraca')?>">Neraca</a></li>                  
                </ul>
              </li>

              <li class="nav-item dropdown <?=isset($laporan)?'active':''?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li class="<?=isset($langgota)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-anggota')?>">Laporan Anggota</a></li>
                  <li class="<?=isset($lsimpnan)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-simpanan')?>">Laporan Simpanan</a></li>
                  <li class="<?=isset($lpinjaman)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-pinjaman')?>">Laporan Pinjaman</a></li>
                  <li class="<?=isset($langsuran)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-angsuran')?>">Laporan Angsuran</a></li>

                  <li class="<?=isset($lneraca)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-neraca')?>">Laporan Neraca</a></li>                  
                  <li class="<?=isset($lshu)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-shu')?>">Laporan SHU Keseluruhan</a></li>
                  <li class="<?=isset($lshup)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-shu-perorangan-2')?>">Laporan SHU Perorangan</a></li>

                  <li class="<?=isset($lpenarikan)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-penarikan')?>">Laporan Penarikan</a></li>                  
                </ul>
                <li class="<?=isset($ganpassword)?'active':''?>"><a class="nav-link" href="<?=base_url('ganti-password')?>"><i class="fas fa-key"></i><span>Ganti Password</span></a></li>
              </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('level') == 'pengawas') : ?>
             <li class="<?=isset($home)?'active':''?>"><a class="nav-link" href="<?=base_url('dashboard')?>"><i class="fas fa-home"></i> <span>Home</span></a></li>

             <li class="menu-header">Main menu :</li>
             <li class="nav-item dropdown <?=isset($laporan)?'active':''?>">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li class="<?=isset($lneraca)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-neraca')?>">Laporan Neraca</a></li>                  
                <li class="<?=isset($lshu)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-shu')?>">Laporan SHU</a></li>
              </ul>
              <li class="<?=isset($ganpassword)?'active':''?>"><a class="nav-link" href="<?=base_url('ganti-password')?>"><i class="fas fa-key"></i><span>Ganti Password</span></a></li>
            </li>
          <?php endif; ?>
          <?php if ($this->session->userdata('level') == 'manajer') : ?>
           <li class="<?=isset($home)?'active':''?>"><a class="nav-link" href="<?=base_url('dashboard')?>"><i class="fas fa-home"></i> <span>Home</span></a></li>

           <li class="menu-header">Main menu :</li>
           <li class="nav-item dropdown <?=isset($laporan)?'active':''?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Laporan</span></a>
            <ul class="dropdown-menu">
              <li class="<?=isset($langgota)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-anggota')?>">Laporan Anggota</a></li>
              <li class="<?=isset($lsimpnan)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-simpanan')?>">Laporan Simpanan</a></li>
              <li class="<?=isset($lpinjaman)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-pinjaman')?>">Laporan Pinjaman</a></li>
              <li class="<?=isset($langsuran)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-angsuran')?>">Laporan Angsuran</a></li>

              <li class="<?=isset($lneraca)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-neraca')?>">Laporan Neraca</a></li>                  
              <li class="<?=isset($lshu)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-shu')?>">Laporan SHU Keseluruhan</a></li>
              <li class="<?=isset($lshup)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-shu-perorangan')?>">Laporan SHU Perorangan</a></li>

              <li class="<?=isset($lpenarikan)?'active':''?>"><a class="nav-link" href="<?=base_url('laporan-penarikan')?>">Laporan Penarikan</a></li>                  
            </ul>
            <li class="<?=isset($ganpassword)?'active':''?>"><a class="nav-link" href="<?=base_url('ganti-password')?>"><i class="fas fa-key"></i><span>Ganti Password</span></a></li>
          </li>
        <?php endif; ?>
        <?php if ($this->session->userdata('level') == 'anggota') : ?>
          <li class="<?=isset($home)?'active':''?>"><a class="nav-link" href="<?=base_url('dashboard')?>"><i class="fas fa-home"></i> <span>Home</span></a></li>

          <li class="menu-header">Main menu :</li>

          <li class="nav-item dropdown <?=isset($master)?'active':''?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Data Master</span></a>
            <ul class="dropdown-menu">
              <li class="<?=isset($anggota)?'active':''?>"><a class="nav-link" href="<?=base_url('anggota')?>">Data Anggota</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown <?=isset($simpan)?'active':''?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-pdf"></i> <span>Data Simpanan</span></a>
            <ul class="dropdown-menu">
              <li class="<?=isset($jenis) && $jenis == 'wajib'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-wajib')?>">Simpanan Wajib</a></li>
              <li class="<?=isset($jenis) && $jenis == 'sukarela'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-sukarela')?>">Simpanan Sukarela</a></li>
              <li class="<?=isset($jenis) && $jenis == 'pokok'?'active':''?>"><a class="nav-link" href="<?=base_url('simpanan-pokok')?>">Simpanan Pokok</a></li>
            </ul>
          </li>

          <li class="<?=isset($pinjaman)?'active':''?>"><a class="nav-link" href="<?=base_url('pinjaman')?>"><i class="fas fa-file"></i> <span>Pinjaman</span></a></li>
          <li class="<?=isset($penarikan)?'active':''?>"><a class="nav-link" href="<?=base_url('penarikan')?>"><i class="fas fa-money-bill"></i> <span>Penarikan</span></a></li>
          <li class="<?=isset($ganpassword)?'active':''?>"><a class="nav-link" href="<?=base_url('ganti-password')?>"><i class="fas fa-key"></i><span>Ganti Password</span></a></li>
        <?php endif; ?>
      </ul>

    </aside>
  </div>

  <!-- Main Content -->
  <?php $this->load->view($body);?>
  <!-- End Main Content -->

  <footer class="main-footer" style="background-color: #6777ef; color: white;">
    <div style="text-align: center">
      Copyright &copy; <?=date('Y')?> &copy <b>Sistem Informasi Koperasi</b>
    </div>
  </footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?=base_url('src/')?>js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?=base_url('src/')?>js/jquery.sparkline.min.js"></script>
<script src="<?=base_url('src/')?>js/Chart.min.js"></script>
<script src="<?=base_url('src/')?>js/owl.carousel.min.js"></script>
<script src="<?=base_url('src/')?>js/jquery.chocolat.min.js"></script>

<!-- Template JS File -->
<script src="<?=base_url('src/')?>js/scripts.js"></script>
<script src="<?=base_url('src/')?>js/custom.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
  } );



  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  <?php echo $this->session->flashdata('msg')?>
  function logout(txt)
  {
    Swal.fire({
      title: 'Apakah anda yakin ?',
      text: "Anda akan keluar dari sistem",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace(txt);
      }
    })
  }
</script>
</body>
</html>
