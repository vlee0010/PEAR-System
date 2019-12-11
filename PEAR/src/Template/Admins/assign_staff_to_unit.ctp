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




            echo $this->Form->input('selectUnit',['required'=>true,'type'=>'select','options'=>$unitList,'label'=>'','showParents' => true,'empty'=>'Select Unit','data-style'=>'btn btn-link','class'=>'form-control js-example-basic-single']);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

            <?php
            echo $this->Form->input('selectStaff',['type'=>'select','options'=>$staffList,'label'=>'','empty'=>'Select Staff','data-style'=>'btn btn-link','class'=>'form-control ']);
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

