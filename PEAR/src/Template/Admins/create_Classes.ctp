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
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Unit Code (FIT3047) </label>
                <input name="unitCode" required class="form-control" type="input" onkeyup="this.value = this.value.toUpperCase();" >
            </div>
        </div>

<!--        Teaching Period-->
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Teaching Period (1,2,A,B) </label>
                <input name="semester" required class="form-control" type="input">
            </div>
        </div>
<!--        Year-->
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Year (2020) </label>
                <input name="year" required maxlength="4" class="form-control" type="input"  >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Class Information (FIT3047 - Mon - 10AM) </label>
                <input name="classInfo" required class="form-control"type="input"  >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Tutor For This Class (Tutor Email Address)</label>
                <input name="tutorEmail" required class="form-control"type="email"  >
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
