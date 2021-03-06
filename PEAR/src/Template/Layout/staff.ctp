<?php
$cakeDescription = 'PEAR Monash: Peer Evaluation & Assessment Resource';
use Cake\View\Helper\BreadcrumbsHelper;
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="canonical" href="https://www.creative-tim.com/product/blk-design-system">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Flash->render(); ?>
</head>
<body class="register-page">

<nav class="navbar navbar-expand-lg navbar-transparent breadcrumb" role="navigation"  color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href='<?=$this->Url->build(['controller'=>'staff','action'=>'index'])?>'   data-placement="bottom" >
                <?php echo $this->Html->image('logo3.jpg',['style'=>'height:30px']);?> <span>PEAR</span> Monash
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
                <?php if(is_null($this->request->getSession()->read('Auth.User.email'))) : ?>
                    <li class="nav-item p-0">
                        <a class="nav-link"  title="Follow us on Twitter" data-placement="bottom" href="<?= $this->Url->build(['controller' => 'staff','action'=>'index']);?>">
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
                        <a class="nav-link d-lg-block"  href='<?=$this->Url->build(['controller'=>'staff', 'action'=>'index'])?>'>
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
<div id="staff-container" class="container">
    <?php $this->Breadcrumbs->prepend('<i class="fas fa-home"></i> Home', ['controller' => 'staff','action' => 'index']) ?>

    <?php $this->Breadcrumbs->templates([
        'wrapper' => '<nav aria-label="breadcrumb" role="navigation"><div class="breadcrumb">
                       
                        &nbsp;&nbsp;{{content}}</div></nav>',
        'item' => '<div class="breadcrumb-item" {{attrs}}><a href="{{url}}" {{innerAttrs}}> {{title}} </a> </div>{{separator}}',
        'itemWithoutLink' => '<div class="breadcrumb-item active" aria-current="page" {{attrs}}><span{{innerAttrs}}> <u>{{title}}</u></span></div>{{separator}}',
        'separator' => '<div{{attrs}}><span{{innerAttrs}}>{{separator}}</span></li>'
    ]) ?>
    <?= $this->Breadcrumbs->render();?>
</div>
<article class="content dashboard-page">
    <?= $this->fetch('content'); ?>
</article>

<footer>
</footer>



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

<!--    <script>-->
<!--        var slider = document.getElementById('sliderRegular');-->
<!---->
<!--        noUiSlider.create(slider, {-->
<!--            start: 1,-->
<!--            connect: [true,false],-->
<!--            range: {-->
<!--                min: 1,-->
<!--                max: 5-->
<!--            }-->
<!--        });-->
<!---->
<!---->
<!--    </script>-->

<script>

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</body>
</html>
