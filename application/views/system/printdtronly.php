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
                            <th rowspan="2">Total Hours</th>
                            <th rowspan="2">Remarks</th>
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
                            <td colspan='7' class="text-center">No Attendance</td>
                            <?php
                        }?>
                        <?php foreach($content as $cnt): ?>
                        <tr class="text-center">
                        <?php if($include_name == 1): ?>
                        <td><?= $cnt['fullname']; ?></td>
                        <?php endif; ?>
                            <td><?= $cnt['log_date']; ?></td>
                            <td>
                                <?php if($cnt['morning_in'] != NULL){ ?>
                                <?= date('h:i A', strtotime($cnt['morning_in']));
                                } ?>
                            </td>
                            <td>
                            <?php if($cnt['morning_out'] != NULL){ ?>             
                                <?= date('h:i A', strtotime($cnt['morning_out']));
                                } ?>
                            </td>
                            <td>
                                <?php if($cnt['afternoon_in'] != NULL){ ?>
                                <?= date('h:i A', strtotime($cnt['afternoon_in']));
                                } ?>
                            </td>
                            <td>
                                <?php if($cnt['afternoon_out'] != NULL){ ?>
                                <?= date('h:i A', strtotime($cnt['afternoon_out']));
                                } ?>
                            </td>
                            <td><?php 
                            $hours = (abs(strtotime($cnt['morning_out'] ?? 0)-strtotime($cnt['morning_in'] ?? 0))+ abs(strtotime($cnt['afternoon_out'] ?? 0)-strtotime($cnt['afternoon_in'] ?? 0)))/3600;
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
                            <td>
                                <input type="text" name="remarks" class="form-control myremarks">
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
        var inputValues = document.querySelectorAll('.myremarks');
        inputValues.forEach(function(input) {
            var para = document.createElement('p');
            para.textContent = input.value;
            input.parentElement.appendChild(para);
            input.style.display = 'none';
        });
        var printContents = document.getElementById(divName).innerHTML;
        document.body.innerHTML = '<h4 class="text-center text-success">DAILY TIME RECORD</h4>';
        <?php if($include_name == 0){ ?>
            document.body.innerHTML += '<h5>Name: <?= $fullname; ?> </h5>';
        <?php }else{?>
            document.body.innerHTML += '<h5>Name: All Staff </h5>';
        <?php } ?>
        document.body.innerHTML += '<?php if(count($date)!=0){ ?> <h5>For the Month of: <?= $date['date']; ?></h5><?php } ?>';
        document.body.innerHTML += printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>