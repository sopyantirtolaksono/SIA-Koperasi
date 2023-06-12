<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Informasi Koperasi</title>
  <link rel="icon" type="image/x-icon" href="<?=base_url('src/img/logo.png')?>">
  <meta name="description" content="Sistem informasi koperasi ini merupakan sistem yang digunakan untuk mempermudah pelayanan dan pendataan koperasi simpan pinjam.">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>/node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/src/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/src/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-3">
        <div class="row justify-content-center">

          <div class="col-xl-12 text-center mt-5">
            <img src="<?=base_url('src/img/logo.png')?>" alt="logo" width="100"><br><br>
            <h3>Sistem Informasi<br>Koperasi</h3><br>
          </div>

          <div class="col-xl-4">
            <div class="card card-primary">
              <div class="card-body">
                <form method="POST" action="<?=base_url('auth/aksiLogin')?>">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" required class="form-control" name="username"  placeholder="Masukan username anda">
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                      </div>
                    </div>
                    <input id="password" name="password" type="password" class="form-control" required placeholder="Masukan password anda">
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?=base_url()?>/src/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/src/js/scripts.js"></script>
  <script src="<?=base_url()?>/src/js/custom.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
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
  </script>

  <!-- Page Specific JS File -->
</body>
</html>
