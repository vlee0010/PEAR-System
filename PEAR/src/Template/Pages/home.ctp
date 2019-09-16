<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

    </title>

    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <?= $this->Html->css('nucleo-icons.css') ?>

    <?= $this->Html->css('blk-design-system.css') ?>
    <?= $this->Html->css('demo.css') ?>

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
</head>

<body class="index-page">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#"  title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                <span>PEAR</span> Monash123456
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
                <li class="nav-item p-0">
                    <a class="nav-link"  title="Follow us on Twitter" data-placement="bottom" href="<?= $this->Url->build(['controller' => 'pages','action'=>'display']);?>">
                        <i class="fas fa-home"></i>
                        <p class="d-lg-none d-xl-none">Home</p>
                    </a>
                </li>


                <?php if(is_null($this->request->session()->read('Auth.User.email'))) : ?>

                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href=<?=$this->Url->build(['controller'=>'users','action'=>'login'])?>>
                            <i class="tim-icons icon-single-02"></i> Login
                        </a>
                    </li>
                <?php else :?>
                    <li class="nav-item">
                        <a class="nav-link d-lg-block"  href='<?=$this->Url->build(['controller'=>'users', 'action'=>'studentdash'])?>'>
                            <i class="tim-icons icon-single-02"></i><?= "Hello, " . $this->request->session()->read('Auth.User.email');?>
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
<!-- End Navbar -->
<div class="wrapper">
    <div class="page-header header-filter">
        <div class="squares square1"></div>
        <div class="squares square2"></div>
        <div class="squares square3"></div>
        <div class="squares square4"></div>
        <div class="squares square5"></div>
        <div class="squares square6"></div>
        <div class="squares square7"></div>
        <div class="container">
            <div class="content-center brand">
                <h1 class="h1-seo">PEAR</h1>
                <h3>A complete Re-Design for Monash Student Peer Review. </h3>
            </div>


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

<?= $this->Html->script('demo.js') ?>
<?= $this->Html->script('blk-design-system.min.js?v=1.0.0') ?>


<script>
    $(document).ready(function() {
        blackKit.initDatePicker();
        blackKit.initSliders();
    });

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>




</body>

</html>



