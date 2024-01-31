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
                        <h4 class="mr-2 mt-1">Period:</h4>
                        <div class="form-group">
                            <!-- <input type="date" name="start_date" class="form-control" id="start_date"> -->
                            <select name="monthdate" id="monthdate" class="form-control">
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">Decemeber</option>
                            </select>
                            <input type="hidden" name="monthtext" id="monthtext">
                            <input type="hidden" name="include" id="include" value="0">
                        </div>
                        <h3 class="px-2"> : </h3>
                        <div class="form-group">
                            <!-- <input type="date" name="end_date" class="form-control" id="end_date"> -->
                            <select name="yeardate" id="yeardate" class="form-control">
                              <option value="2024">2024</option>
                              <option value="2023">2023</option>
                              <option value="2022">2022</option>
                              <option value="2021">2021</option>
                              <option value="2020">2020</option>

                            </select>
                        </div>
                        <h3 class="px-2"> : </h3>
                        <div class="form-group">
                            <select name="choices" id="mychoice" class="form-control">
                              <option value="1">DTR With PIC</option>
                              <option value="2">DTR Only</option>
                              <option value="3">PIC Only</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="rfid" value="<?= $this->session->userdata('rfid'); ?>" class="form-control" id="myrfid">
                        </div>
                        <div class="form-group">
                          <button id="opendtr" class="btn btn-info ml-2"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                        </div>
                    </div>
                    </form>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr class="text-center align-items-center">
                            <th rowspan="2">Date</th>
                            <th colspan="2">AM</th>
                            <th colspan="2">PM</th>
                            <th rowspan="2">Total Hours</th>
                        </tr>
                        <tr class="text-center">
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($attendance)): 
                        if(count($attendance)==0){ ?>
                            <td colspan='6' class="text-center">No Attendance</td>
                            <?php
                        }?>
                        <?php foreach($attendance as $cnt): ?>
                        <tr>
                            <td><?= $cnt['log_date']; ?></td>
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
                            <td><?php 
                            $hours = (abs(strtotime($cnt['morning_out'])-strtotime($cnt['morning_in']))+ abs(strtotime($cnt['afternoon_out'])-strtotime($cnt['afternoon_in'])))/3600;
                            // Get the whole number part (hours)
                            $wholeHours = floor($hours);                          
                            // Get the decimal part (minutes)
                            $decimalMinutes = ($hours - $wholeHours) * 60;                          
                            // Format the result as hours and minutes
                            $formattedTime = sprintf("%02d:%02d", $wholeHours, $decimalMinutes);
                          
                            if($hours >24){
                                echo "__:__";
                            }else{
                                echo $formattedTime;
                            }
                            ?> hours</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
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