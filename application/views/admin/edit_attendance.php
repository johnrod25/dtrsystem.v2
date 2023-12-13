<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                <div class="">
                    <h3>Edit Attendance</h3>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center align-items-center">
                            <th rowspan="2">RFID Number</th>
                            <th rowspan="2">Fullname</th>
                            <th colspan="2">AM</th>
                            <th colspan="2">PM</th>
                            <th rowspan="2">Log Date</th>
                            <th rowspan="2">Actions</th>
                        </tr>
                        <tr class="text-center">
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($attendance)):
                        foreach($attendance as $cnt): 
                    ?>
                    <tr class="text-capitalize">
                        <td><?= $cnt['rfid']; ?></td>
                        <td><?= $cnt['fullname']; ?></td>
                        <td><?php if($cnt['morning_in'] != NULL){ 
                          echo date('h:i A', strtotime($cnt['morning_in']));
                        } ?></td>
                        <td><?php if($cnt['morning_out'] != NULL){ 
                          echo date('h:i A', strtotime($cnt['morning_out']));
                        } ?></td>
                        <td><?php if($cnt['afternoon_in'] != NULL){ 
                          echo date('h:i A', strtotime($cnt['afternoon_in']));
                        } ?></td>
                        <td><?php if($cnt['afternoon_out'] != NULL){ 
                          echo date('h:i A', strtotime($cnt['afternoon_out']));
                        } ?></td>
                        <td><?= $cnt['log_date']; ?></td>
                        <!-- <td>
                        <a class="btn btn-success" value="<?= $cnt['rfid']; ?>" onclick="editAttendance(<?= $cnt['id']; ?>)">Edit</button>
                          <a class="btn btn-success" value="<?= $cnt['rfid']; ?>" onclick="saveAttendance(<?= $cnt['rfid']; ?>)">Save</button>
                        </td> -->
                        <td class="text-center ">
                            <a data-toggle="tooltip" title="Edit" class="btn btn-primary btn-xs" value="<?= $cnt['rfid']; ?>" onclick="editAttendance(<?= $cnt['id']; ?>)"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php 
                      endforeach;
                      endif; 
                    ?>                     
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modal-edit-attendance">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Attendance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation px-3" id="form-sched-edit" novalidate>
              <!-- First Row -->
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Employee Name:</label>
                  <input type="hidden" class="form-control text-capitalize" id="edit_id" disabled>
                  <input type="text" class="form-control text-capitalize" id="fullname" disabled>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Morning Start Time:</label>
                  <input type="time" name="morning_in" class="form-control" id="edit_morning_in" step="1">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Morning End Time:</label>
                  <input type="time" name="morning_out" class="form-control" id="edit_morning_out" step="1">
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon Start Time:</label>
                  <input type="time" name="afternoon_in" class="form-control" id="edit_afternoon_in" step="1">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon End Time:</label>
                  <input type="time" name="afternoon_out" class="form-control" id="edit_afternoon_out" step="1">
                  </div>
              </div>                                   
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-attendance" onclick="updateAttendance()">Update Attendance</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-schedule">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Schedule</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation px-3" id="form-sched" novalidate>
              <!-- First Row -->
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Employee Name:</label>
                  <select class="form-control text-capitalize" name="empname" id="empname">
                      <!-- Load employee name from database -->
                      <option value="">Select</option>
                      <?php
                      if(isset($fullname)){
                      foreach($fullname as $cnt){
                        $fname = $cnt['firstname']." ".$cnt['midname']." ".$cnt['lastname'];
                          print"<option value=".json_encode($cnt['id']).">".$fname."</option>";
                      }
                      } ?>
                    </select>
                    </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Morning Start Time:</label>
                  <input type="time" name="morning_in" class="form-control" id="morning_in">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Morning End Time:</label>
                  <input type="time" name="morning_out" class="form-control" id="morning_out">
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon Start Time:</label>
                  <input type="time" name="afternoon_in" class="form-control" id="afternoon_in">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon End Time:</label>
                  <input type="time" name="afternoon_out" class="form-control" id="afternoon_out">
                  </div>
              </div>                                   
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add-schedule">Add Schedule</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  function editAttendance(id){
    $.ajax({
            url: "<?php echo base_url(); ?>edit-attd-schedule",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                if (data.response === 'success') {
                  $('#modal-edit-attendance').modal('show');
                  $("#edit_id").val(data.post[0].id);
                  $("#fullname").val(data.post[0].fullname);
                  $("#edit_morning_in").val(data.post[0].morning_in);
                  $("#edit_morning_out").val(data.post[0].morning_out);
                  $("#edit_afternoon_in").val(data.post[0].afternoon_in);
                  $("#edit_afternoon_out").val(data.post[0].afternoon_out);
                } else {
                  errorToast(data.message);
                }
            }
        });
  }

  function updateAttendance(){
    var edit_id = $("#edit_id").val();
    var fullname =  $("#fullname").val();
    var edit_morning_in =  $("#edit_morning_in").val();
    var edit_morning_out =  $("#edit_morning_out").val();
    var edit_afternoon_in =  $("#edit_afternoon_in").val();
    var edit_afternoon_out =  $("#edit_afternoon_out").val();
    if (edit_id == "") {
      alert("both field is required");
    } else {
        $.ajax({
            url: "<?php echo base_url(); ?>update-my-attendance",
            type: "post",
            dataType: "json",
            data: {
              id: edit_id,
              fullname: fullname,
              morning_in: edit_morning_in,
              morning_out: edit_morning_out,
              afternoon_in: edit_afternoon_in,
              afternoon_out: edit_afternoon_out
            },success: function(data) {
                if (data.response === 'success') {
                    $('#modal-edit-attendance').modal('hide');
                    localStorage.setItem("Notif",JSON.stringify(data));
                    window.location.reload(); 
                  } else {
                  errorToast(data.message);
                }
            }
        });
      }
  }

</script>