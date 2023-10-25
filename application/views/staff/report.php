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
                    <form role="form" id="form" action="<?php echo base_url(); ?>printmydtr" method="POST">
                    <div class="col-md-12 d-flex text-center justify-content-center">
                        <div class="form-group">
                            <input type="date" name="start_date" class="form-control" id="start_date">
                            <input type="hidden" name="rfid" id="myrfid">
                        </div>
                        <h3 class="px-2"> : </h3>
                        <div class="form-group">
                            <input type="date" name="end_date" class="form-control" id="end_date">
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
                                <a data-toggle="tooltip" title="Print" class="btn btn-primary btn-xs" id="opendtr" value="<?= $cnt['rfid']; ?>"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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