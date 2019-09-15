<br> <section>
    <h1 class="main-heading"><strong>Reset your password</strong></h1> </section>
<div class="register-photo"> <div class="form-container">
        <!--The reset password form-->
        <?= $this->Form->create(); ?>
        <label for="password"><strong>Password <font
                    style="color:#C3232D;">*</font></strong></label>
        <?= $this->Form->password('password', ['type'=>'password','id' =>
            'password','placeholder'=>'new password']); ?>
        <label for="confirm_password"><strong>Confirm password <font
                    style="color:#C3232D;">*</font></strong></label>
        <?= $this->Form->password('confirm_password', ['id' =>
            'confirm_password','placeholder'=>'has to be same as above']); ?> <section class="text-center"><?= $this->Form->submit('Reset',array('class'=>'btn btn- primary','id'=>'btn_submit','onClick'=>'checkIn()')); ?></section>
        <?= $this->Form->end(); ?> </div>
</div>


