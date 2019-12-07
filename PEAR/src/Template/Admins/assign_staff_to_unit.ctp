<?php $this->layout = 'default-staff';
//$this->layout = false;
?>


<h1>Assign Staff To Unit</h1>
<br>
<br>
<br>
<br>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">


            <?php
            $unitAll = [];
            $staffAll = [];

            foreach($unitList as $unit){
                $unitInformation =array( ''. $unit->id =>$unit->code . ' '.$unit->title. ' Semester ' . $unit->semester .' '. $unit->year);
                array_push($unitAll,$unitInformation);
            }
            foreach($staffList as $staff){
                $staffInformation = array(''.$staff->id => $staff->firstname . ' '. $staff->lastname );
                array_push($staffAll,$staffInformation);
            }

            echo $this->Form->input('selectUnit',['type'=>'select','options'=>$unitAll,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control']);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <?php
            echo $this->Form->input('selectStaff',['type'=>'select','options'=>$staffAll,'label'=>'','empty'=>'Select Staff','data-style'=>'btn btn-link','class'=>'form-control ']);
            ?>
        </div>

    </div>
</div>


<?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']);?>
<?php echo $this->Form->end();?>



<script>
    const AssignStaffToUnitTab = document.querySelector('#assignstafftounit');
    AssignStaffToUnitTab.classList.add('active');
</script>

