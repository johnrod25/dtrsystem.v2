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
                    <h3>Manage Report</h3>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>RFID Number</th>
                            <th>Fullname</th>
                            <th>Department</th>
                            <th>Log Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            if(isset($content)):
                            $i=1; 
                            foreach($content as $cnt): 
                        ?>
                        <tr>
                            <td><?= $cnt['rfid']; ?></td>
                            <td><?= $cnt['firstname'].' '.$cnt['midname'].' '.$cnt['lastname']; ?></td>
                            <td><?= $cnt['department_name']; ?></td>
                            <td><?= $cnt['log_date']; ?></td>
                            <td class="text-center ">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">January</a>
                                        <a class="dropdown-item" href="#">February</a>
                                        <a class="dropdown-item" href="#">March</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php 
                      $i++;
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