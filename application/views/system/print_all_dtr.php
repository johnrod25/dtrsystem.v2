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
                            <?php if($_SESSION['usertype' == 2]){ ?>
                            <th rowspan="2">Remarks</th>
                            <?php } ?>
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
                        <?php array_map(function($cnt,$img) use ($include_name){ ?>
                        <tr class="text-center">
                            <?php if(isset($include_name) && $include_name == 1) { ?>
                            <td><?= $img['fullname']; ?></td>
                            <?php } ?> 
                            <td><?= $cnt['log_date']; ?></td>
                            <td>
                                <?php if($cnt['morning_in'] != NULL){ 
                                    $img_morning_in = ($img['morning_in'] == '' ? 'default.png':$img['morning_in']);
                                ?>
                                <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img_morning_in; ?>" alt="" class="rounded mx-auto d-block" style="height:50px;">
                                <?= date('h:i A', strtotime($cnt['morning_in']));
                                } ?>
                            </td>
                            <td>
                            <?php if($cnt['morning_out'] != NULL){ 
                                $img_morning_out = ($img['morning_out'] == '' ? 'default.png':$img['morning_out']); 
                            ?>
                                <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img_morning_out; ?>" alt="" class="rounded mx-auto d-block" style="height:50px;">
                                <?= date('h:i A', strtotime($cnt['morning_out']));
                                } ?>
                            </td>
                            <td>
                                <?php if($cnt['afternoon_in'] != NULL){ 
                                    $img_afternoon_in = ($img['afternoon_in'] == '' ? 'default.png':$img['afternoon_in']); 
                                ?>
                                <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img_afternoon_in; ?>" alt="" class="rounded mx-auto d-block" style="height:50px;">
                                <?= date('h:i A', strtotime($cnt['afternoon_in']));
                                } ?>
                            </td>
                            <td>
                                <?php if($cnt['afternoon_out'] != NULL){ 
                                    $img_afternoon_out = ($img['afternoon_out'] == '' ? 'default.png':$img['afternoon_out']);
                                ?>
                                <img src="<?=base_url(); ?>/assets/dist/img/attendance/<?= $img_afternoon_out; ?>" alt="" class="rounded mx-auto d-block" style="height:50px;">
                                <?= date('h:i A', strtotime($cnt['afternoon_out']));
                                } ?>
                            </td>
                            <td><?php 
                            $hours = (abs(strtotime($cnt['morning_out'] ?? 0)-strtotime($cnt['morning_in'] ?? 0))+ abs(strtotime($cnt['afternoon_out'] ?? 0)-strtotime($cnt['afternoon_in'] ?? 0)))/3600;
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
                            <?php if($_SESSION['usertype' == 2]){ ?>
                            <td>
                                <!-- if usertype = 2 show input remark  -->
                                <input type="text" name="remarks" class="form-control myremarks">
                            </td>
                            <?php } ?>
                        </tr>
                        <?php },$content, $images); ?>
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