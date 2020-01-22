<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>



<h2><?=$user->firstname . ' ' . $user->lastname;?>'s Profile</h2>

<?php
echo $this->Form->create(); ?>
<div class="row mt-5">
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstname">User First Name</label>
            <?php echo $this->Form->input('firstname',['label'=>'','id'=>'firstname','placeholder'=>$user->firstname,'class'=>'form-control','value'=>$user->firstname]);?>

        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lastname">User Last Name</label>
            <?php echo $this->Form->input('lastname',['label'=>'','id'=>'lastname','placeholder'=>$user->firstname,'class'=>'form-control','value'=>$user->lastname]);?>
        </div>


    </div>
</div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email Address</label>
                <?php echo $this->Form->input('email',['label'=>'','id'=>'email','placeholder'=>$user->email,'class'=>'form-control','value'=>$user->email]);?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password">New Password</label>
                <?php echo $this->Form->input('password',['label'=>'','id'=>'password','placeholder'=>'','class'=>'form-control']);?>
            </div>
        </div>


    </div>



<?= $this->Form->submit('Submit',['class'=>'btn btn-large btn-primary pull-right', 'id' =>'submit-btn']);?>
<?= $this->Form->end() ?>



<script>
    const userTab = document.querySelector('#viewUsers');
    userTab.classList.add('active');
</script>
