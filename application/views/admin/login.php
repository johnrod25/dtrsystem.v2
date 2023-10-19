
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
    <div class="container">
        <div class="card d-flex m-5">
        <form class="row g-3 needs-validation p-3" id="form-login" novalidate>
            <h1 class="align-center">Login</h1>
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
            <button type="submit" class="btn btn-primary col-md-12" id="formLogin">Login</button>                                
        </form>
        </div>
    </div>
    <script>
        //LOGIN
    $(document).on("click", "#formLogin", function(e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        url: "<?php echo base_url(); ?>loginValid",
        type: "post",
        dataType: "json",
        data: {
            username: username,
            password: password
        },
        success: function(data) {
            if (data.response == "success") {
                
            } else {
                
            }
        }
    });
    });
    </script>
</body>
</html>
