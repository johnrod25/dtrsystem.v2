$(document).on('click', '#add', function(e) {
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
                fetch();
                $('#modal-lg').modal('hide')
                $("#form")[0].reset();
                Command: toastr["success"](data.message)
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
                location.reload();
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
                    console.log(data.post[0].firstname);
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
    if (edit_id == "" || edit_rfid == "" || edit_lname == "" || edit_fname == "" || edit_mname == "" || edit_dob == "" || edit_gender == "" || edit_civil_status == "" || edit_department == "" || edit_number == "" || edit_email == "" || edit_address == "") {
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
                // fetch();
                if (data.response === 'success') {
                    $('#modal-edit').modal('hide');
                    Command: toastr["success"](data.message)
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
                    location.reload();
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