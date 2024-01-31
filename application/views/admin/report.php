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
                    <form role="form" id="form" action="<?php echo base_url(); ?>print-report" method="POST">
                    <div class="col-md-12 d-flex text-center justify-content-center">
                        <h4 class="mr-2 mt-1">Period:</h4>
                        <div class="form-group">
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <h3 class="px-2"> : </h3>
                        <div class="form-group">
                            <input type="date" name="end_date" class="form-control" id="end_date">
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
                          <input type="hidden" name="monthtext" id="monthtext">
                          <input type="hidden" name="include" id="include" value="0">
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="rfid" id="myrfid">
                          <input type="hidden" name="fullname" id="myfullname">
                        </div>
                        <div class="form-group">
                        <input type="button" class="btn btn-primary ml-3" value="View All" onclick="view_print_dtr('1','1')">
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
                            <td><?= $fullname = $cnt['firstname'].' '.$cnt['midname'].' '.$cnt['lastname']; ?></td>
                            <td><?= $cnt['department_name']; ?></td>
                            <td><?= $cnt['log_date']; ?></td>
                            <td class="text-center ">
                                <a data-toggle="tooltip" title="Print" class="btn btn-info btn-sm" id="print-dtr" value="<?= $cnt['rfid']; ?>" onclick="view_print_dtr('<?= $cnt['rfid']; ?>','<?= $fullname; ?>')"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
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