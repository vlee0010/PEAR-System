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
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    <?= $this->Html->script('progressbar.min.js') ?>

    <style>
        .progress-box {
            margin: 20px;
            width: 50px;
            height: 50px;
            position: relative;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-transparent " color-on-scroll="100">
    <div  class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href='<?=$this->Url->build(['controller'=>'staff','action'=>'index'])?>'   data-placement="bottom" >
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
    <h1>Unit List</h1>
    <div class="row">
        <?php foreach($unit_list as $index => $unit):?>
            <div class="card col-12 col-md-4 col-lg-3">
                <div style="display: flex;align-items: center;justify-content: center"class="card-img" >
                    <h2 style="color:black;margin:0;"><?=$unit->code;?></h2>
                    <!--                    <img style="max-width: 100%"src="https://source.unsplash.com/user/vincentyaha/likes?sig=--><?//=rand()?><!--" alt="">-->
                </div>
                <div class="card-text d-flex justify-content-between" style="padding:50px">
<!--                    <div>-->
<!--                        <div class="progress-box" id="xyz--><?//=$index?><!--" style="margin:0 auto;"></div>-->
<!--                    </div>-->
                    <div style="margin:0 auto">
                        <a id="staff-unit-item" class="" href=<?=$this->Url->build(['action'=>'displayclass',$unit->id]);?>><?=$unit->title?></a>
                    </div>
                </div>
            </div>
            <script>
                // progressbar.js@1.0.0 version is used
                // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

                var bar = new ProgressBar.Circle('#xyz<?=$index?>', {
                    color: '#5972FF',
                    //
                    // This has to be the same size as the maximum width to
                    // prevent clipping
                    strokeWidth: 5,
                    trailWidth: 3,
                    easing: 'easeInOut',
                    duration: 2400,
                    text: {
                        autoStyleContainer: true
                    },
                    from: { color: '#5972FF', width: 3 },
                    to: { color: '#000', width: 4 },
                    // Set default step function for all animate calls
                    step: function(state, circle) {
                        circle.path.setAttribute('stroke', state.color);
                        circle.path.setAttribute('stroke-width', state.width);

                        var value = Math.round(circle.value() * 100);
                        if (value === 0) {
                            circle.setText('0%');
                        } else {
                            circle.setText(value+'%');
                        }

                    }
                });
                // bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
                bar.text.style.fontSize = '1rem';

                bar.animate(<?=$index?> * 0.1);  // Number from 0.0 to 1.0
            </script>


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
<!--<script type="text/javascript">-->
<!--    bar.animate(0.5);-->
<!--</script>-->

</body>
</html>

