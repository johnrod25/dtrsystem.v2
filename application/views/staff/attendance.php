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
                    <h3>Manage Attendance</h3>
                    <form role="form" id="form" action="<?php echo base_url(); ?>printall" method="POST">
                    <div class="col-md-12 d-flex text-center justify-content-center">
                        <!-- <h4 class="mr-2">Date:</h4> -->
                        <div class="form-group">
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <h3 class="px-2"> : </h3>
                        <div class="form-group">
                            <input type="date" name="end_date" class="form-control" id="end_date">
                        </div>
                        <div class="form-group">
                          <button id="opendtratd" class="btn btn-primary ml-2"><i class="fa fa-print" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>RFID Number</th>
                            <th>Fullname</th>
                            <th>Morning In</th>
                            <th>Morning Out</th>
                            <th>Afternoon In</th>
                            <th>Afternoon Out</th>
                            <th>Log Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($attendance)):
                        foreach($attendance as $cnt): 
                    ?>
                    <tr class="text-capitalize">
                        <td><?= $cnt['rfid']; ?>
                      <input type="hidden" name="rfid"id="rfid"value="<?= $cnt['rfid']; ?>">
                      </td>
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