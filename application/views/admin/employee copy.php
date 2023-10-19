<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                <form class="row g-3 needs-validation px-3" novalidate>
                    <div class="col-md-12 bg-info pt-2 mb-2 rounded text-center text-uppercase font-weight-bold">
                        <p>Personal Information</p>
                    </div>
                    <!-- First Row -->
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>RFID Number</label>
                        <input type="text" name="lname" class="form-control" placeholder="RFID Number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Family Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Family Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="midname" class="form-control" placeholder="Middle Name">
                        </div>
                    </div>
                    <!-- second row -->
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <input type="date" name="txtdob" class="form-control" placeholder="DOB">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Gender</label>
                          <select class="form-control" name="slcgender">
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
                          <select class="form-control" name="civilstatus" id="position">
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
                        <select class="form-control" name="slcdepartment">
                            <option value="">Select</option>
                            <!-- <?php
                      if(isset($department)){
                        foreach($department as $cnt){
                          print "<option value='".$cnt['id']."'>".$cnt['department_name']."</option>";
                        }
                      } ?> -->
                        </select>
                        </div>
                    </div>   
                    <!-- 3rd Row -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="txtmobile" class="form-control" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="txtemail" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Complete Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Complete Address">
                        </div>
                    </div>
                  </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

     <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                    <!-- <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</button> -->
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
                                <input type="hidden" name="id" value="<?= $cnt['id']; ?>">
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-edit" onclick="modalView()"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                <a href="javascript:void(0)" data-id="<?php echo $cnt['id'];?>" class="btn btn-info view-user" onclick="modalView(<?= $cnt['id']; ?>)">View</a>
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
                    <? $data = $_POST['data'];
                    if(isset($modal)):
                        foreach ($modal as $item) : ?>
                    <!-- First Row -->
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>RFID Number</label>
                        <input type="text" name="lname" id="rfid" class="form-control" placeholder="RFID Number" value="<?=$item['rfid']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Family Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Family Name" value="<?=$item['fname']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="midname" id="mname" class="form-control" placeholder="Middle Name">
                        </div>
                    </div>
                  <? endforeach;
                      endif;  ?>
                  </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
