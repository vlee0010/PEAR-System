<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>


<h1>Create Unit</h1>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row mt-5">
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Unit Code (FIT3047) </label>
            <input name="unitCode" required maxlength="7" class="form-control"type="input" onkeyup="this.value = this.value.toUpperCase()" oninvalid="setCustomValidity('Please Enter 3 valid letters faculty code with 4 numeric digits unitCode (E.g. FIT3047)')"
                   oninput="setCustomValidity('')" pattern="[A-Z]{3}[0-9]{4}">
        </div>
    </div>
    <!-- Title   -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Title (Industrial Experience) </label>
            <input name="title" required class="form-control"type="input">
        </div>
    </div>
    <!--Teaching Period -->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Teaching Period (1,2,A,B) </label>
            <input name="semester" required class="form-control" maxlength="1" type="input" oninvalid="setCustomValidity('Please Enter 1,2, or Capitalized A or B.')"
                   oninput="setCustomValidity('')" pattern="[1-2A-B]"  >
        </div>
    </div>
    <!--Year-->
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Year (2020) </label>
            <input name="year" required class="form-control" maxlength="4" type="input"  >
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
    const unitTab = document.querySelector('#create-unit');
    unitTab.classList.add('active');

    const unitExpand = document.querySelector('#unitExpand');

    unitExpand.classList.add('show');
    const crt = document.querySelector('#crt');
    crt.classList.add('active');
    // $(document).ready(function() {
    //     $("input[name='unitCode']").change(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });



</script>

