<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>


<h1>Create Classes</h1>
<?php
echo $this->Form->create(); ?>
<!--Tutor Email-->
<div class="row mt-5">

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
<!--        Teaching Period-->

        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Class Information (FIT3047 - Mon - 10AM) </label>
                <input name="classInfo" required class="form-control"type="input"  >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <?php
                echo $this->Form->input('selectStaff',['type'=>'select','options'=>$staffAll,'label'=>'','empty'=>'Select Staff','data-style'=>'btn btn-link','class'=>'form-control ']);
                ?>
            </div>
        </div>
        <!-- Class Name   -->

        <!--Semester-->

</div>



<br>
<!--    <input type="checkbox" name="question1" value="Do you like your team?"> Do you like your team?<br>-->
<!--    <input type="checkbox" name="question2" value="Do you want to work with your teammates in the future?"> Do you want to work with your teammates in the future?<br>-->
<!--    <input type="checkbox" name="question3" value="How do you like Your mentors?" checked> How do you like Your mentors? <br><br>-->
<?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']);?>
<?php echo $this->Form->end();?>




<script>
    // Create Peer Review highlight Tab
    const ccTab = document.querySelector('#cc');
    ccTab.classList.add('active');
    const submit = document.querySelector('.submit');
    submit.classList.add('m-auto');

    //    "<i class=\"material-icons\">create</i>"
    //     const submitBtn = document.querySelector('#submit-btn');
    //     let submitIcon = document.createElement('i');
    //     submitBtn.setAttribute("class",'material-icons');
    //     submitBtn.innerText = 'create';
    // //
    //     submitBtn.appendChild(submitBtn);
</script>
