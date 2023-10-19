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
                    <h3>Manage Department</h3>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-department"><i class="fa fa-plus" aria-hidden="true"></i> Add Department</button>
                </div>
                <hr class="hr">
                <table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Department Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($department)):
                        foreach($department as $cnt): 
                    ?>
                    <tr class="text-capitalize">
                        <td><?= $cnt['department_name']; ?></td>
                        <td><?= $cnt['department_desc']; ?></td>
                        <td class="text-center ">
                            <a data-toggle="tooltip" title="Edit" class="btn btn-primary btn-xs" id="edit-department" value="<?= $cnt['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs" id="delet" onclick="deleteItem('delete-department',<?= $cnt['id']; ?> )" value="<?= $cnt['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<div class="modal fade" id="modal-department">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation px-3" id="form-dept" novalidate>
              <!-- First Row -->
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Department Name:</label>
                  <input type="text" name="department" class="form-control" placeholder="Department Name" id="department_name">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Department Description:</label>
                  <input type="text" name="depdesc" class="form-control" placeholder="Department Description" id="department_desc">
                  </div>
              </div>          
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add-department">Add</button>
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
        <h4 class="modal-title">Edit Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="row g-3 needs-validation px-3" id="form-dept" novalidate>
              <!-- First Row -->
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Department Name:</label>
                  <input type="hidden" class="form-control" id="edit_id">
                  <input type="text" name="department" class="form-control" placeholder="Department Name" id="edit_department_name">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                  <label>Department Description:</label>
                  <input type="text" name="depdesc" class="form-control" placeholder="Department Description" id="edit_department_desc">
                  </div>
              </div>          
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update-department">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->