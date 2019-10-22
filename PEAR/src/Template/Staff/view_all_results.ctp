<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\I18n\Number;

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


<!--starts here-->


<div id="staff-container" class="container">
    <?php foreach ($unit_activity as $unit_activity):?>
        <h1><?=$unit_activity->unitcode. " " . $unit_activity->activity?></h1>
    <?php endforeach;?>

    <div align="right"><?= $this->element('Staff/Buttons/csv', ['url' => ['action' => 'export',$unit_activity->peer_id]]) ?></div>
    <div>
        <table class="table" >
            <thead>
            <tr>
                <th>Student</th>
                <th>Team</th>
                <?php foreach ($questions_desc as $questions_desc):?>
                    <th class="text-center"><?=$questions_desc->question?></th>
                <?php endforeach;?>
                <th>Comment</th>

            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($student_list as $student_list):
                    $comment = "";?>
                    <tr>
                        <td><?=$student_list->firstname." ".$student_list->lastname?></td>
                        <td><?=$student_list->team?></td>
                        <?php foreach ($student_result_array as $item):
                            if ($item->student_id == $student_list->student_id):
                                $float = (float)$item->average_score;?>
                                <td align="center"><?=Number::format($float,['precision' => 1])?></td>
                            <?php endif;
                        endforeach;?>
                        <?php foreach($student_comment_list as $item):
                            if ($item->ratee_id == $student_list->student_id):
                                $comment .= "<b>".$item->student_firstname. " ".$item->student_lastname. ":</b>. ".$item->comment;
                                $comment .= "<br/>";
                            endif;
                        endforeach;?>
                        <td align="center"><button id="button_<?php echo $student_list->student_id?>" " type="button"
                                    class="btn btn-info btn-simple btn-icon btn-sm"
                                    data-container="body"
                                    data-toggle="popover"
                                    data-placement="left"
                                    data-html = "true"
                                    data-content = "<?=$comment?>">
                                <i class="fas fa-comments"></i>
                            </button></td>
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>
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
