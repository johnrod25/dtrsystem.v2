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
                    <h3>Manage Employee</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</button>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>RFID Number</th>
                            <th>Fullname</th>
                            <th>Department</th>
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
                            <td class="text-center ">
                                <a data-toggle="tooltip" title="Edit" class="btn btn-primary btn-xs" id="edit-staff" value="<?= $cnt['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs" onclick="deleteItem('delete-staff',<?= $cnt['id']; ?> )"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row g-3 needs-validation px-3" id="form">
                <div class="col-md-12 bg-info pt-2 mb-2 rounded text-center text-uppercase font-weight-bold">
                    <h5>Personal Information</h5>
                </div>
                <!-- First Row -->
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                    <label>RFID Number</label>
                    <input type="text" name="lname" class="form-control" placeholder="RFID Number" id="rfid">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="First Name" id="fname">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="midname" class="form-control" placeholder="Middle Name" id="mname">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" id="lname">
                    </div>
                </div>
                <!-- second row -->
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="txtdob" class="form-control" placeholder="DOB" id="dob">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="slcgender" id="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label>Civil Status</label>
                        <select class="form-control" name="civilstatus" id="civilstatus">
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorce">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                    <label>Department</label>
                    <select class="form-control" name="slcdepartment" id="department">
                        <option value="">Select</option>
                        <?php
                    if(isset($department)){
                    foreach($department as $cnt){
                        print "<option value='".$cnt['id']."'>".$cnt['department_name']."</option>";
                    }
                    } ?>
                    </select>
                    </div>
                </div>   
                <!-- 3rd Row -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="txtmobile" class="form-control" placeholder="Mobile" id="mobile">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="txtemail" class="form-control" placeholder="Email" id="email">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Complete Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Complete Address" id="address">
                    </div>
                </div>
                </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-staff">Add</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="userDetailModal">Edit Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-content">
                <form class="row g-3 needs-validation px-3" novalidate>
                    <div class="col-md-12 bg-info pt-2 mb-2 rounded text-center text-uppercase font-weight-bold">
                        <p>Personal Information</p>
                    </div>                    
                    <!-- First Row -->
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>RFID Number</label>
                        <input type="hidden" name="edit_id" id="edit_id" class="form-control">
                        <input type="hidden" name="edit_rfid2" id="edit_rfid2" class="form-control">
                        <input type="text" name="edit_rfid" id="edit_rfid" class="form-control" placeholder="RFID Number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="edit_fname" id="edit_fname" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="edit_mname" id="edit_mname" class="form-control" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="edit_lname" id="edit_lname" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <!-- second row -->
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <input type="date" name="edit_dob" class="form-control" placeholder="DOB" id="edit_dob">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Gender</label>
                          <select class="form-control" name="edit_gender" id="edit_gender">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Civil Status</label>
                          <select class="form-control" name="edit_civil_status" id="edit_civil_status">
                          <option value="">Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorce">Divorced</option>
                            <option value="Widowed">Widowed</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="edit_department" id="edit_department">
                            <option value="">Select</option>
                         <?php
                            if(isset($department)){
                            foreach($department as $cnt){
                            print "<option value='".$cnt['id']."'>".$cnt['department_name']."</option>";
                            }
                        } ?>
                        </select>
                        </div>
                    </div>   
                    <!-- 3rd Row -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="edit_number" class="form-control" placeholder="Mobile" id="edit_number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="edit_email" class="form-control" placeholder="Email" id="edit_email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Complete Address</label>
                            <input type="text" name="edit_address" class="form-control" placeholder="Complete Address" id="edit_address">
                        </div>
                    </div>
                  </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="update-staff">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
