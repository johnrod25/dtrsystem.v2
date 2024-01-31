<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
<div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between bg-secondary">
                <h5 class="card-title  text-center">Daily Time Record</h5>
                
            </div>
            <section class="card-body" id="dtr">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center align-items-center">
                            <?php if($include_name == 1): ?>
                            <th rowspan="2">Name</th>
                            <?php endif; ?>
                            <th rowspan="2">Date</th>
                            <th colspan="2">AM</th>
                            <th colspan="2">PM</th>
                            <?php if($_SESSION['usertype'] == 2){ ?>
                            <th rowspan="2">Remarks</th>
                            <?php } ?>
                            <!-- <th rowspan="2">Total Hours</th> -->
                        </tr>
                        <tr class="text-center">
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($images)): 
                        if(count($images)==0){ ?>
                            <td colspan='7' class="text-center">No Attendance</td>
                            <?php } ?>
                            <?php foreach($images as $img): ?>
                            <tr class="text-center">
                                <?php if($include_name == 1): ?>
                                <td><?= $img['fullname']; ?></td>
                                <?php endif; ?>
                                <td><?= $img['log_date']; ?></td>
                                <td>
                                    <?php if($img['morning_in'] != NULL){ ?>
                                    <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img['morning_in']; ?>" alt=""class="rounded mx-auto d-block" style="height:50px;">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($img['morning_out'] != NULL){ ?>
                                    <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img['morning_out']; ?>" alt=""class="rounded mx-auto d-block" style="height:50px;">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($img['afternoon_in'] != NULL){ ?>
                                    <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img['afternoon_in']; ?>" alt=""class="rounded mx-auto d-block" style="height:50px;">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($img['afternoon_out'] != NULL){ ?>
                                    <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img['afternoon_out']; ?>" alt=""class="rounded mx-auto d-block" style="height:50px;">
                                    <?php } ?>
                                </td>
                                <?php if($_SESSION['usertype'] == 2){ ?>
                            <td>
                                <!-- if usertype = 2 show input remark  -->
                                <input type="text" name="remarks" class="form-control myremarks">
                            </td>
                            <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <div class="div">
                <button type="button" class="btn btn-success pull-right float-right m-3" onclick="printDiv('dtr')"><i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </div>

          </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function printDiv(divName){
        var inputValues = document.querySelectorAll('.myremarks');
        inputValues.forEach(function(input) {
            var para = document.createElement('p');
            para.textContent = input.value;
            input.parentElement.appendChild(para);
            input.style.display = 'none';
        });
        var printContents = document.getElementById(divName).innerHTML;
        document.body.innerHTML = '<div class="border-top mt-3"><h6>CS Form 48</h6></div>';
        document.body.innerHTML += '<h4 class="text-center text-success">DAILY TIME RECORD</h4>';
        <?php if($include_name == 0){ ?>
            document.body.innerHTML += '<h5>Name: <span class="border-bottom border-dark"><?= $fullname; ?></span> </h5>';
        <?php }else{?>
            document.body.innerHTML += '<h5>Name: <span class="border-bottom border-dark"> All Staff</span> </h5>';
        <?php } ?>
        document.body.innerHTML += '<?php if(count($date)!=0){ ?> <h5>For the Month of: <span class="border-bottom border-dark"><?= $date['date']; ?></span></h5><?php } ?>';
        document.body.innerHTML += '<h5  style="min-width:700px;">Official hours (Reg. Days): <span class="border-bottom border-dark" style="min-width:300px;"></span> </h5><h5 style="min-width:700px;">Arrival & Departure (Sun & Holidays): <span class="border-bottom border-dark" style="min-width:300px;"></span> </h5>';
        document.body.innerHTML += printContents;
        document.body.innerHTML += '<p>I  CERTIFY on my honor that the above is true and correct of the hours of work performed, record of which was made duty at the time of arrival and at departure from the office.</p>';
        document.body.innerHTML += ' <div class="m-5 border-top border-dark text-center" style="width:300px;"><h6>Signature</h6></div><div class="m-5 border-top border-dark text-center" style="width:300px;"><h6>In Charge</h6></div><p class="mb-3">Valid to the prescribed office hours</p><div class="box"><h6>RBASASHS-DTR-022</h6><h6>Effectivity: January 1, 2024</h6><h6>Revision: 0</h6></div>';
        window.print();

        document.body.innerHTML = originalContents;

    }
</script>