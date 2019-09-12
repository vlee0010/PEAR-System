

<div class="wrapper">
    <div class="page-header">
        <div class="page-header-image"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
                        <div id="square7" class="square square-7"></div>
                        <div id="square8" class="square square-8"></div>
                        <div class="card card-register">
                            <div class="card-header">
                                <img class="card-img" src="<?=$this->Url->image('square1.png')?>" alt="Card image">
                                <h4 class="card-title">Log In</h4>
                            </div>
                            <div class="card-body">
                                <?= $this->Form->create();?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <?=$this->Form->text('email',array('type'=>'text','name'=>'email','class'=>'form-control','placeholder'=>'Monash Email'));?>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <?= $this->Form->text('password', array('type'=>'password','class'=>'form-control', 'placeholder'=>'Password','name'=>'password'));?>
                                </div>
                                <!--                                    <div class="form-check text-left">-->
                                <!--                                        <label class="form-check-label">-->
                                <!--                                            <input class="form-check-input" type="checkbox" required>-->
                                <!--                                            <span class="form-check-sign"></span>-->
                                <!--                                            I agree to the-->
                                <!--                                            <a href="#">terms and conditions</a>.-->
                                <!--                                        </label>-->
                                <!--                                    </div>-->

                                <div class="card-footer">

                                    <?=$this->Form->submit('Log In', array('class' => 'btn btn-info btn-round btn-lg'));?>


                                </div>
                                <?=$this->Form->end();?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="register-bg"></div>
                <div id="square1" class="square square-1"></div>
                <div id="square2" class="square square-2"></div>
                <div id="square3" class="square square-3"></div>
                <div id="square4" class="square square-4"></div>
                <div id="square5" class="square square-5"></div>
                <div id="square6" class="square square-6"></div>
            </div>
        </div>
    </div>



