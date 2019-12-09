

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
                                <img class="card-img" src="<?=$this->Url->image('square1.png')?>" alt="Card image">
                                <h4 style="margin-left:20px;text-transform: capitalize;"class="card-title">Log In</h4>
                            </div>
                            <div class="card-body">
                                <?= $this->Form->create();?>
                                <?= $this->Form->input('_type', ['type'=>'hidden', 'value' => 'login']);?>
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
                                    <?= $this->Form->text('password', array('type'=>'password',"autocomplete"=>"new-password",'class'=>'form-control', 'placeholder'=>'Password','name'=>'password'));?>

                                </div>

                                <div class="card-footer">
                                    <!--                                    //Modal Button-->
                                    <button type="button" class="btn-link" style="position:relative;top:-30px;" data-toggle="modal" data-target="#exampleModal">
                                        Reset Password
                                    </button>
                                    <?=$this->Form->submit('Login', array('class' => 'btn btn-info btn-round btn-lg'));?>
                                    <?=$this->Form->end();?>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Password Reset</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $this->Form->create();?>
                                                    <?= $this->Form->input('_type', ['type'=>'hidden', 'value' => 'reset']);?>
                                                    <?=$this->Form->text('email',array('type'=>'email','auto-complete'=>'none','style'=>'color:black','name'=>'email','class'=>'form-control','placeholder'=>'Enter Your Monash Email','pattern'=>'[a-z0-9]+@student+\.+monash+\.+edu'));?>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                    <?=$this->Form->text('Submit', ['type'=>'submit','class'=>"btn btn-success", 'style'=>'text-align:center;']);?>
                                                    <?=$this->Form->end();?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-3 text-white">
                            <br>
                            <br>
                             <?php echo $this->Html->image('logo3.jpg', ['style'=>'height:80px']);?>
                            PEAR
                            <br>
                            <br>
                            <span class="text-white text-left">Peer Evaluation & Assessment Resource </span>
                        </h1>
                        <p class="text-white mb-3 text-left"></p>

                    </div>
                </div>
                <div id="square2" class="square square-2"></div>
                <div id="square3" class="square square-3"></div>
                <div id="square4" class="square square-4"></div>
                <div id="square5" class="square square-5"></div>
                <div id="square6" class="square square-6"></div>
            </div>
        </div>
    </div>



