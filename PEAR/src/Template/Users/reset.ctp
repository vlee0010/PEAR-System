<div class="wrapper">
    <div class="page-header">
        <div class="page-header-image"></div>
        <div class="content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3 order-12">


                        <div id="square7" class="square square-7"></div>
                        <div id="square8" class="square square-8"></div>

                        <div class="card card-register">

                            <div class="card-header">
                                <img class="card-img" src="<?= $this->Url->image('square1.png') ?>" alt="Card image">
                                <h4 style="margin-left:20px;text-transform: capitalize;" class="card-title">Reset</h4>
                            </div>
                            <div class="card-body">
                                <?= $this->Form->create(); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>


                                    <?= $this->Form->text('password', array('type' => 'password', 'id' => 'password', "autocomplete" => "none", 'class' => 'form-control', 'placeholder' => 'New Password', 'name' => 'password')); ?>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <?= $this->Form->text('confirm_password', ['type' => 'password', 'id' =>
                                        'confirm_password', 'class' => 'form-control', 'placeholder' => 'Enter New Password Again']); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?= $this->Form->text('Change Password', ['type' => 'submit', 'value' => 'Change Password', 'class' => "btn btn-success", 'style' => 'text-align:center;']); ?>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-3 text-white">
                            <br>
                            <br>
                            <?php echo $this->Html->image('logo3.jpg', ['style' => 'height:80px']); ?>
                            PEAR
                            <br>
                            <br>
                            <span class="text-white text-left">Peer Evaluation & Assessment Resource </span>
                        </h1>
                        <p class="text-white mb-3 text-left"></p>

                    </div>
                </div>


            </div>

        </div>

    </div>

</div>

</div>
<div id="square2" class="square square-2"></div>
<div id="square3" class="square square-3"></div>
<div id="square4" class="square square-4"></div>
<div id="square5" class="square square-5"></div>
<div id="square6" class="square square-6"></div>






