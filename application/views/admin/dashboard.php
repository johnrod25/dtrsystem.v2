<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid mt-2">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Departments</span>
                        <span class="info-box-number"><?= count($department); ?></span>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>       
                        <div class="info-box-content">
                            <span class="info-box-text">Staff</span>
                            <span class="info-box-number"><?= count($staff);?></span>
                        </div>
                    </div>
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">Attendance</span>
                        <span class="info-box-number"><?= count($attendance); ?></span>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>        
                    <div class="info-box-content">
                        <span class="info-box-text">In/Out Today</span>
                        <span class="info-box-number"><?= count($content); ?></span>
                    </div>
                    </div>
                </div>
            </div>
                <!-- /.row -->
        </div>
    </section>
     <!-- /.content -->

     <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                    <div class="text-center">
                        <h3 class="text-warning text-bold">ATTENDANCE FOR TODAY</h3>
                        <hr class="hr">
                    </div>
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
                        if(isset($content)):
                        foreach($content as $cnt): 
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