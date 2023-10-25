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
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Morning Start Time</th>
                            <th>Morning End Time</th>
                            <th>Afternoon Start Time</th>
                            <th>Afternoon End Time</th>
                            <th>Total Hours</th>
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
                        <td><?= $cnt['fullname']; ?></td>
                            <td><?= $cnt['log_date']; ?></td>
                            <td><?= $cnt['morning_in']; ?></td>
                            <td><?= $cnt['morning_out']; ?></td>
                            <td><?= $cnt['afternoon_in']; ?></td>
                            <td><?= $cnt['afternoon_out']; ?></td>
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

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>