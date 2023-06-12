<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Anggota</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Master</div>
        <div class="breadcrumb-item">Data Anggota</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="<?=base_url('anggota_add')?>" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col" width="3%">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kontak</th>
                  <th scope="col">Pekerjaan</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($anggota as $row) { ?>
                  <tr>
                    <td scope="row"><?=$no++?></td>
                    <td align="left"><?=ucwords($row->anggota_nik)?><br><?=ucwords($row->anggota_nama)?></td>
                    
                    <td align="left"><?=ucfirst($row->anggota_alamat)?><br><?=$row->anggota_nohp?></td>
                    <td><?=ucfirst($row->anggota_pekerjaan)?></td>
                    <td>                    
                      <a href="<?=base_url('anggota_edit/'.$row->anggota_kode)?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                      <button type="button" onclick="return confirmdelete('<?=base_url('anggota_delete/'.$row->anggota_kode)?>')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                      <?php if ($this->session->userdata('level') == 'bendahara'): ?>
                        <a href="<?=base_url('bukti-anggota/'.$row->anggota_nik)?>" target="_blank" class="btn btn-success btn-sm"><span class="fa fa-print"></span></a>
                      <?php endif ?>
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

<script>
  function confirmdelete(txt)
  {
    Swal.fire({
      title: 'Apakah anda yakin ?',
      text: "Anda akan menghapus data anggota",
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