<?php
$this->layout = 'default-staff';
?>
<h1>Create New Question</h1>
<?php
echo $this->Form->create(); ?>
<!--Unit Code-->
<div class="row mt-5">
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Question description </label>
            <input name="question" class="form-control" type="input">
        </div>
    </div>
    <?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']);?>
    <?php echo $this->Form->end();?>




    <script>
        // Create Peer Review highlight Tab
        const cnqTab = document.querySelector('#cnq');
        cnqTab.classList.add('active');
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
