<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h3>Manage Schedule</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-schedule"><i class="fa fa-plus" aria-hidden="true"></i> Add Schedule</button>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Morning Start Time</th>
                            <th>Morning End Time</th>
                            <th>Afternoon Start Time</th>
                            <th>Afternoon End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($schedule)):
                        foreach($schedule as $sched): 
                    ?>
                    <tr class="text-capitalize">
                        <td><?= $sched['fullname']; ?></td>
                        <td><?= date('h:i A', strtotime($sched['morning_in'])); ?></td>
                        <td><?= date('h:i A', strtotime($sched['morning_out'])); ?></td>
                        <td><?= date('h:i A', strtotime($sched['afternoon_in'])); ?></td>
                        <td><?= date('h:i A', strtotime($sched['afternoon_out'])); ?></td>
                        <td class="text-center ">
                            <a data-toggle="tooltip" title="Edit" class="btn btn-primary btn-xs" id="edit-schedule" value="<?= $sched['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
                          print"<option value=".json_encode($cnt['rfid']).">".$fname."</option>";
                      }
                      } ?>
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

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Schedule</h4>
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
                  <input type="time" name="morning_in" class="form-control" id="edit_morning_in">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Morning End Time:</label>
                  <input type="time" name="morning_out" class="form-control" id="edit_morning_out">
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon Start Time:</label>
                  <input type="time" name="afternoon_in" class="form-control" id="edit_afternoon_in">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Afternoon End Time:</label>
                  <input type="time" name="afternoon_out" class="form-control" id="edit_afternoon_out">
                  </div>
              </div>                                   
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-schedule">Update Schedule</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->