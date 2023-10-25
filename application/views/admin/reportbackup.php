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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> fsfsd</button>
                                <a data-toggle="tooltip" title="Edit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" value="<?= $cnt['rfid']; ?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/1/<?= $cnt['rfid']; ?>">January</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/2/<?= $cnt['rfid']; ?>">February</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/3/<?= $cnt['rfid']; ?>">March</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/4/<?= $cnt['rfid']; ?>">April</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/5/<?= $cnt['rfid']; ?>">May</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/6/<?= $cnt['rfid']; ?>">June</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/7/<?= $cnt['rfid']; ?>">July</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/8/<?= $cnt['rfid']; ?>">August</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/9/<?= $cnt['rfid']; ?>">September</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/10/<?= $cnt['rfid']; ?>">October</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/11/<?= $cnt['rfid']; ?>">November</a>
                                        <a class="dropdown-item" href="<?= base_url(); ?>print-dtr/12/<?= $cnt['rfid']; ?>">December</a>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>