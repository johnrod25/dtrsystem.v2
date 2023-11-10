
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    .container{
        height: 100vh;
    }
    .container .card{
        width: 350px;

    }
    .logo-img img{
        height:50px;
    }
  </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card d-flex m-5 py-4 px-3">
        <?php echo form_open('Home/login'); ?>
            <!-- <h1 class="text-center">DTR SYSTEM</h1> -->
            <div class="col-md-12 logo-img d-flex justify-content-center align-items-center mb-3">
            <img src="<?php echo base_url(); ?>assets/dist/img/logo.jpg" alt="RBASASHS" class="brand-image img-circle elevation-3" style="opacity: .8; width:80px; height:80px;">
            <!-- <h1 class="text-center ml-2">DTR SYSTEM</h1> -->
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label>Username:</label>
                  <input type="text" name="username" class="form-control" id="username">
                </div>
            </div>   
            <div class="col-md-12">
                <div class="form-group">
                  <label>Password:</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>   
            <div class="col-md-12 text-danger my-2">
                <?php echo $this->session->flashdata('login_error', 1); ?> 
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
            </div>                              
        </form>
        </div>
    </div>

</body>
</html>
