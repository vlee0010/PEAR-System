<?php $this->layout = 'default-staff';
//$this->layout = false;
?>


<h1>Assign Staff To Unit</h1>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row mt-5">
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Unit Code (FIT3047) </label>
            <input name="unitCode" class="form-control"type="input"  >
        </div>
    </div>


    <!--Semester-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Teaching Period (1,2,A,B) </label>
            <input name="semester" class="form-control"type="input"   >
        </div>
    </div>
    <!--Year-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Year (2020) </label>
            <input name="year" class="form-control"type="input"  >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Staff Email </label>
            <input name="staffEmail" class="form-control"type="input"  >
        </div>
    </div>

</div>



<br>
<!--    <input type="checkbox" name="question1" value="Do you like your team?"> Do you like your team?<br>-->
<!--    <input type="checkbox" name="question2" value="Do you want to work with your teammates in the future?"> Do you want to work with your teammates in the future?<br>-->
<!--    <input type="checkbox" name="question3" value="How do you like Your mentors?" checked> How do you like Your mentors? <br><br>-->
<?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']);?>
<?php echo $this->Form->end();?>



<script>
    const AssignStaffToUnitTab = document.querySelector('#assignstafftounit');
    AssignStaffToUnitTab.classList.add('active');
</script>

