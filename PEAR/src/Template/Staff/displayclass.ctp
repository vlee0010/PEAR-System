<?php
/**
 * @var \App\View\AppView $this
 */
$this->layout=false;
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->meta('icon') ?>


    <?= $this->Html->css('nucleo-icons.css') ?>
    <?= $this->Html->css('blk-design-system.css') ?>
    <?= $this->Html->css('staff.css')?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="canonical" href="https://www.creative-tim.com/product/blk-design-system">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-transparent " color-on-scroll="100">
    <div  class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href='<?=$this->Url->build(['controller'=>'pages','action'=>'display'])?>'   data-placement="bottom" >
                <span>PEAR</span> Monash
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a>
                            PEAR
                        </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <?php if(is_null($this->request->session()->read('Auth.User.email'))) : ?>

                    <li class="nav-item p-0">
                        <a class="nav-link"  title="Follow us on Twitter" data-placement="bottom" href="<?= $this->Url->build(['controller' => 'pages','action'=>'display']);?>">
                            <i class="fas fa-home"></i>
                            <p class="d-lg-none d-xl-none">Home</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href=<?=$this->Url->build(['controller'=>'users','action'=>'login'])?>>
                            <i class="tim-icons icon-single-02"></i> Sign In
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href=<?=$this->Url->build(['controller'=>'users','action'=>'register'])?>>
                            <i class="tim-icons icon-spaceship"></i> Sign Up
                        </a>
                    </li>
                <?php else :?>


                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href='<?=$this->Url->build(['controller'=>'users', 'action'=>'studentdash'])?>'>
                            <i class="tim-icons icon-single-02"></i><?= "Hello, " . $this->request->session()->read('Auth.User.firstname');?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href=<?=$this->Url->build(['controller'=>'users','action'=>'logout'])?>>
                            <i class="tim-icons icon-single-02"></i>Sign Out
                        </a>
                    </li>

                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>


<!--starts here-->


<div id="staff-container" class="container">
    <h1>Class Section List</h1>
    <div class="row">


<?php foreach($class_list as $class):?>
        <div class="card col-12 col-md-4 col-lg-3">
            <div class="card-img" >
                <img src="https://source.unsplash.com/user/vincentyaha/likes?sig=<?=rand()?>" alt="">
            </div>
            <div class="card-text">
                <a id="class-list-item" href=<?=$this->Url->build(['action'=>'displaystudent',$class->id,$peer_id]);?>><?=$class->class_name?></a>
            </div>

        </div>

<?php endforeach;?>

</div>
</div>



<?= $this->Html->script('core/jquery.min.js') ?>
<?= $this->Html->script('core/popper.min.js') ?>
<?= $this->Html->script('core/bootstrap.min.js') ?>
<?= $this->Html->script('plugins/perfect-scrollbar.jquery.min.js') ?>
<?= $this->Html->script('plugins/bootstrap-switch.js') ?>
<?= $this->Html->script('plugins/nouislider.min.js') ?>
<?= $this->Html->script('plugins/chartjs.min.js') ?>
<?= $this->Html->script('plugins/moment.min.js') ?>
<?= $this->Html->script('plugins/bootstrap-datetimepicker.js') ?>

<?= $this->Html->script('blk-design-system.min.js') ?>
<?= $this->Html->script('blk-design-system.min.js?v=1.0.0') ?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>
</html>
