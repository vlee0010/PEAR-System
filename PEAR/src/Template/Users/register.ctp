
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
                                <img class="card-img" src="<?= $this->Url->image('square1.png')?>" alt="Card image">
                                <h5 class="card-title">Sign Up</h5>
                            </div>
                            <div class="card-body">
                                    <?php $this->Form->setTemplates([
                                    'inputContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
                                    'input'         => '<input type="{{type}}" class="form-control" name="{{name}}" {{attrs}}/>',
                                    'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>'
                                ]); ?>
                                <?= $this->Form->create($user);?>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-single-02"></i>
                                            </div>
                                        </div>
                                        <?= $this->Form->text('firstname',array('required' => false, 'type'=>'text', 'placeholder'=>'First Name'));?>
                                    </div>


                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <?= $this->Form->text('lastname',array('required' => false, 'type'=>'text', 'placeholder'=>'Last Name'));?>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <?= $this->Form->text('studentid',array('required' => false, 'type'=>'text', 'placeholder'=>'Student Id'));?>
                                </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-email-85"></i>
                                            </div>
                                        </div>
                                        <?=$this->Form->text('email',array('required' => false, 'type'=>'email',
                                            'name'=>'email',
                                            'placeholder'=>'Monash Email',
                                            'pattern'=>'[a-z0-9]+@student+\.+monash+\.+edu'
                                            //'oninvalid' => 'setCustomValidity(\'Without trailing zero\')'
                                            ));

                                       ?>

                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tim-icons icon-lock-circle"></i>
                                            </div>
                                        </div>
                                        <?= $this->Form->text('password', array('required' => false, 'type'=>'password', 'placeholder'=>'Password','name'=>'password'));?>
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

                                        <?=$this->Form->submit('Register', array('class' => 'btn btn-info btn-round btn-lg'));?>


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
