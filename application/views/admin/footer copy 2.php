  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; 2023 <a href="https://adminlte.io">RHS</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Bootstrap -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url(); ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- My AJAX -->
<!-- <script src="<?= base_url(); ?>assets/plugins/custom/ajax.js"></script> -->

<script>
  $(document).ready(function() {
    $('#example').DataTable();
    let notif = JSON.parse(localStorage.getItem('Notif'));
    if(notif != null){
      Command: toastr[notif.response](notif.message)
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        localStorage.clear();
    }
  } );

  // STAFF 
  $(document).on('click', '#add-staff', function(e) {
    e.preventDefault();
    var rfid = $("#rfid").val();
    var lname = $("#lname").val();
    var fname = $("#fname").val();
    var mname = $("#mname").val();
    var dob = $("#dob").val();
    var gender = $("#gender").val();
    var civilstatus = $("#civilstatus").val();
    var department = $("#department").val();
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var address = $("#address").val();
    $.ajax({
        url: "<?php echo base_url(); ?>insert",
        type: "post",
        dataType: "json",
        data: {
            rfid: rfid,
            lastname: lname,
            firstname : fname ,
            midname: mname,
            dob: dob,
            gender: gender,
            civil_status: civilstatus,
            department_id: department,
            number: mobile,
            email: email,
            address: address
        },
        success: function(data) {
            if (data.response == "success") {
              $('#modal-lg').modal('hide')
              $("#form")[0].reset();
              localStorage.setItem("Notif",JSON.stringify(data));
              window.location.reload(); 
            } else {
              //localStorage.setItem("Notif",JSON.stringify(data));
                Command: toastr[data.response](data.message)
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        }
    });
});

$(document).on("click", "#edit", function(e) {
    e.preventDefault();

    var edit_id = $(this).attr("value");

    if (edit_id == "") {
        alert("Edit id required");
    } else {
        $.ajax({
            url: "<?php echo base_url(); ?>edit",
            type: "post",
            dataType: "json",
            data: {
                edit_id: edit_id
            },
            success: function(data) {
                if (data.response === 'success') {
                    $('#modal-edit').modal('show');
                    $("#edit_id").val(data.post[0].id);
                    $("#edit_rfid").val(data.post[0].rfid);
                    $("#edit_lname").val(data.post[0].lastname);
                    $("#edit_fname").val(data.post[0].firstname);
                    $("#edit_mname").val(data.post[0].midname);
                    $("#edit_dob").val(data.post[0].dob);
                    $("#edit_gender").val(data.post[0].gender);
                    $("#edit_civil_status").val(data.post[0].civil_status);
                    $("#edit_department").val(data.post[0].department_id);
                    $("#edit_number").val(data.post[0].number);
                    $("#edit_email").val(data.post[0].email);
                    $("#edit_address").val(data.post[0].address);
                } else {
                  localStorage.setItem("Notif",JSON.stringify(data))
                }
            }
        });
    }
});

$(document).on("click", "#update", function(e) {
    e.preventDefault();
    var edit_id = $("#edit_id").val();
    var edit_rfid =  $("#edit_rfid").val();
    var edit_lname =  $("#edit_lname").val();
    var edit_fname =  $("#edit_fname").val();
    var edit_mname =  $("#edit_mname").val();
    var edit_dob =  $("#edit_dob").val();
    var edit_gender =  $("#edit_gender").val();
    var edit_civil_status =  $("#edit_civil_status").val();
    var edit_department =  $("#edit_department").val();
    var edit_number =  $("#edit_number").val();
    var edit_email =  $("#edit_email").val();
    var edit_address =  $("#edit_address").val();
    if (edit_id == "") {
      alert("both field is required");
    } else {
        $.ajax({
            url: "<?php echo base_url(); ?>update",
            type: "post",
            dataType: "json",
            data: {
                id: edit_id,
                rfid: edit_rfid,
                lastname: edit_lname,
                firstname: edit_fname,
                midname: edit_mname,
                dob: edit_dob,
                gender: edit_gender,
                civil_status: edit_civil_status,
                department_id: edit_department,
                number: edit_number,
                email: edit_email,
                address: edit_address
            },
            success: function(data) {
                if (data.response === 'success') {
                    $('#modal-edit').modal('hide');
                    localStorage.setItem("Notif",JSON.stringify(data))
                    window.location.reload(); 
                } else {
                  Command: toastr["error"](data.message)
                  toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                }
            }
        });
        $("#update_form")[0].reset();
    }
});

function deleteItem(route, del_id){
  if (del_id == "") {
        alert("Delete id required");
    } else {
      if (confirm('Are you sure you want to delete this ?')) {
        $.ajax({
          url: "<?php echo base_url(); ?>"+route,
          type: "post",
          dataType: "json",
          data: {
            del_id: del_id
          },
          success: function(data) {
            if (data.response === 'success') {
              localStorage.setItem("Notif",JSON.stringify(data))
              window.location.reload(); 
            }
          }
        });
      }
    }
};
// STAFF 
$(document).on('click', '#add-staff', function(e) {
    e.preventDefault();
    var rfid = $("#rfid").val();
    var lname = $("#lname").val();
    var fname = $("#fname").val();
    var mname = $("#mname").val();
    var dob = $("#dob").val();
    var gender = $("#gender").val();
    var civilstatus = $("#civilstatus").val();
    var department = $("#department").val();
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var address = $("#address").val();
    $.ajax({
        url: "<?php echo base_url(); ?>insert",
        type: "post",
        dataType: "json",
        data: {
            rfid: rfid,
            lastname: lname,
            firstname : fname ,
            midname: mname,
            dob: dob,
            gender: gender,
            civil_status: civilstatus,
            department_id: department,
            number: mobile,
            email: email,
            address: address
        },
        success: function(data) {
            if (data.response == "success") {
              $('#modal-lg').modal('hide')
              $("#form")[0].reset();
              localStorage.setItem("Notif",JSON.stringify(data));
              window.location.reload(); 
            } else {
              //localStorage.setItem("Notif",JSON.stringify(data));
                Command: toastr[data.response](data.message)
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        }
    });
});

// $(document).on("click", "#delete", function(e) {
//   e.preventDefault();
//   var route = $(this).attr("value");
//   var del_id = $(this).attr("value");
//   if (del_id == "") {
//         alert("Delete id required");
//     } else {
//       if (confirm('Are you sure you want to delete this?')) {
//         $.ajax({
//           url: "<?php echo base_url(); ?>delete",
//           type: "post",
//           dataType: "json",
//           data: {
//             del_id: del_id
//           },
//           success: function(data) {
//             if (data.response === 'success') {
//               localStorage.setItem("Notif",JSON.stringify(data))
//               window.location.reload(); 
//             }
//           }
//         });
//       }
//     }
// });

</script>
</body>
</html>