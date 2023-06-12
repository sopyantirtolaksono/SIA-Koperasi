<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Simpanan <?=ucwords($jenis)?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Simpanan</div>
        <div class="breadcrumb-item"><?=ucwords($jenis)?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="<?=base_url($jenis.'_add')?>" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col" width="3%">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Waktu</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($data as $row) { ?>
                  <tr>
                    <td scope="row"><?=$no++?></td>
                    <td><?=ucwords($row->anggota_nama)?></td>
                    <td>Rp. <?=number_format($row->simpanan_jumlah)?></td>
                    <td><?=date('H:i',strtotime($row->simpanan_waktu))?>, <?=tanggal(date('Y-m-d',strtotime($row->simpanan_waktu)))?></td>
                    <td>                    
                      <a href="<?=base_url($jenis.'_edit/'.$row->simpanan_kode)?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                      <button type="button" onclick="return confirmdelete('<?=base_url('simpanan_delete/'.$row->simpanan_kode.'/'.$jenis)?>','<?=$jenis?>')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                      <?php if ($this->session->userdata('level') == 'bendahara'): ?>
                        <a href="<?=base_url('bukti_simpanan'.$jenis.'/'.$row->simpanan_kode)?>" target="_blank" class="btn btn-success btn-sm"><span class="fa fa-print"></span></a>
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
  function confirmdelete(txt,jenis)
  {
    Swal.fire({
      title: 'Apakah anda yakin ?',
      text: "Anda akan menghapus data simpanan "+jenis,
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