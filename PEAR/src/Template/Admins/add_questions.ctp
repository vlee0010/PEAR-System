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
