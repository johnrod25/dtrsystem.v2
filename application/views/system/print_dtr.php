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
                            <th rowspan="2">Date</th>
                            <th colspan="2">AM</th>
                            <th colspan="2">PM</th>
                            <th rowspan="2">Total Hours</th>
                        </tr>
                        <tr class="text-center">
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($content)): 
                        if(count($content)==0){ ?>
                            <td colspan='6' class="text-center">No Attendance</td>
                            <?php
                        }?>
                        <?php foreach($content as $cnt): ?>
                        <tr>
                            <td><?= $cnt['log_date']; ?></td>
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
                            <td><?php 
                            $hours = (abs(strtotime($cnt['morning_out'])-strtotime($cnt['morning_in']))+ abs(strtotime($cnt['afternoon_out'])-strtotime($cnt['afternoon_in'])))/3600;
                            // Get the whole number part (hours)
                            $wholeHours = floor($hours);                          
                            // Get the decimal part (minutes)
                            $decimalMinutes = ($hours - $wholeHours) * 60;                          
                            // Format the result as hours and minutes
                            $formattedTime = sprintf("%02d:%02d", $wholeHours, $decimalMinutes);
                          
                            if($hours >24){
                                echo "__:__";
                            }else{
                                echo $formattedTime;
                            }
                            ?> hours</td>
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
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = '<h4 class="text-center text-success">DAILY TIME RECORD</h4>';
        document.body.innerHTML += '<?php if(count($content)!=0){ ?>
                <h5>Name: <?= $content[0]['fullname']; ?></h5><?php } ?>';
        document.body.innerHTML += '<?php if(count($date)!=0){ ?>
                <h5>For the Month of: <?= $date['date']; ?></h5><?php } ?>';
        // document.body.innerHTML += '<h5>For the Month of: October 2023</h5>';
        document.body.innerHTML += printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>