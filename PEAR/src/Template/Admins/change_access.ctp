<?php $this->layout = 'default-staff';
//$this->layout = false;
?>

<style>
    .select2-container--default .select2-selection--single{
        border:none;
        background-color: transparent;
    }
</style>
<h1>Change User role to Tutor</h1>
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




            echo $this->Form->input('selectUser',['required'=>true,'type'=>'select','options'=>$userList,'label'=>'','id'=>'changeAccessTab','showParents' => true,'empty'=>'Select User','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single']);?>
        </div>
    </div>

</div>


<?= $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right','value'=>'Change User to Staff']);?>
<?php echo $this->Form->end();?>



<script>




    $(document).ready(function() {
        $('#changeAccessTab').select2();
    });
    const AssignStaffToUnitTab = document.querySelector('#changeAccess');
    AssignStaffToUnitTab.classList.add('active');





    document.querySelector('.select2-selection .select2-selection--single').parentElement.classList.add('form-control');
</script>

