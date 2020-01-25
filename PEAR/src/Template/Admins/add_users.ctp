<?php
//$this->layout=  false;
$this->layout = 'default-staff';
?>


    <h1>Add New User</h1>
<?php
echo $this->Form->create(); ?>
<div class="row mt-5">
    <div class="col-md-6">
        Email:
        <label for="email"></label>
        <div class="form-group bmd-form-group" >

            <input required name="email" class="form-control" placeholder="Please Enter A Valid Monash Email Address "type="email" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>


    <div class="col-md-6">
        Role:
        <label for="role"></label>
        <div class="form-group bmd-form-group" >
            <br>
            <select required name="role" class="form-control" type="select" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                <option value="2">Staff</option>
                <option value="3">Admin</option>
            </select>

        </div>
    </div>
</div>
<!--2nd Row-->
    <div class="row mt-5">
        <div class="col-md-6">
            First Name:
            <label for="firstname"></label>
            <div class="form-group bmd-form-group" >
                <input required name="firstname" class="form-control" placeholder="Please Enter User's First Name"type="text" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
            </div>
        </div>


        <div class="col-md-6">
            Last Name:
            <label for="lastname"></label>
            <div class="form-group bmd-form-group" >

                <input required name="lastname" class="form-control" placeholder="Please Enter User's Last Name"type="text" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
            </div>
        </div>
    </div>
<!--3rd Row-->

<div class="row mt-5">
    <div class="col-md-6">
        Password:
        <label for="password"></label>
        <div class="form-group bmd-form-group" >

            <input required name="password" class="form-control" type="password" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>
</div>




<?= $this->Form->submit('Add New User',['class'=>'btn btn-large btn-primary pull-right', 'id' =>'submit-btn']);?>
<?php echo $this->Form->end();?>
<script>
    const addUser = document.querySelector('#add-user');
    addUser.classList.add('active');
</script>

