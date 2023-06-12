<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Master</div>
        <div class="breadcrumb-item">Data User</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="<?=base_url('user_add')?>" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col" width="3%">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($user as $row) { ?>
                <tr>
                  <td scope="row"><?=$no++?></td>
                  <td><?=ucwords($row->user_nama)?></td>
                  <td><?=$row->user_username?></td>
                  <td>                    
                    <a href="<?=base_url('user_edit/'.$row->user_id)?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                    <button type="button" onclick="return confirmdelete('<?=base_url('user_delete/'.$row->user_id)?>')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
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
    text: "Anda akan menghapus data user",
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