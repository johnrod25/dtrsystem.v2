<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Main content -->
    <section class="content-header">
    <div class="container-fluid">
<div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between bg-secondary">
                <h5 class="card-title  text-center">Daily Timeeee Record</h5>
                
            </div>
            <section class="card-body" id="dtr">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center align-items-center">
                            <th rowspan="2">Name</th>
                            <th rowspan="2">Date</th>
                            <th colspan="2">AM</th>
                            <th colspan="2">PM</th>
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
                                <td><?= $img['fullname']; ?></td>
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
        //alert('dsdffsd');
        var printContents = document.getElementById(divName).innerHTML;
        document.body.innerHTML = '<h4 class="text-center text-success">DAILY TIME RECORD</h4>';
        document.body.innerHTML += '<h5>Name: All Staff </h5>';
        document.body.innerHTML += '<?php if(count($date)!=0){ ?>
                <h5>For the Month of: <?= $date['date']; ?></h5><?php } ?>';
        // document.body.innerHTML += '<h5>For the Month of: October 2023</h5>';
        document.body.innerHTML += printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>