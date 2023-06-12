<div class="main-content">
  <section class="section">
    <div class="row">
      
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Anggota</h4>
            </div>
            <div class="card-body">
              <?=$this->db->get('anggota')->num_rows();?> Anggota
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-user-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Staff</h4>
            </div>
            <div class="card-body">
              <?=$this->db->get('user')->num_rows();?> Staff
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="fas fa-calendar"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4><?=tanggal(date('Y-m-d'))?></h4>
            </div>
            <div class="card-body">
              <span id="jam"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body text-center">
            Selamat data di <b>Sistem Informasi Koperasi Simpan Pinjam Arofah Kendal</b><br>
            Pada sistem ini anda bisa mengelola data anggota, staff, simpanan, dan juga pinjaman yang dilakukan anggota serta anda juga dapat membuat laporan berdasarkan data yang sudah ada pada sistem.<br><br>
            User login : <b><?=$this->session->userdata('nama')?></b>.
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
    window.onload = function() { jam(); }
   
    function jam() {
     var e = document.getElementById('jam'),
     d = new Date(), h, m, s;
     h = d.getHours();
     m = set(d.getMinutes());
     s = set(d.getSeconds());
   
     e.innerHTML = h +':'+ m +':'+ s;
   
     setTimeout('jam()', 1000);
    }
   
    function set(e) {
     e = e < 10 ? '0'+ e : e;
     return e;
    }
   </script>