<?php
/**
 * @var \App\View\AppView $this
 */

?>

<!--starts here-->
<?php $this->Breadcrumbs->add($unit->code . ' ' . $unit->title) ?>
<div id="staff-container" class="container">
    <div class="container-fluid">
        <main class="col-12 col-md-auto col-xl-auto py-md-3 pl-md-6 bd-content" role="main">
            <h1><?= $unit->code ?> Class List</h1>
            <div style="justify-content: center" class="row" align="center">
                <?php if (count($selectedClassList) != 0): ?>
                    <?php foreach ($selectedClassList as $class): ?>
                        <div style="position:relative; min-height:100px; min-width:600px; justify-content: center"
                             class="d-flex col-12 col-md-4 col-lg-3">
                            <?php if ($peer_id): ?>
                                <div style="position: absolute;top:50%;left:50%;transform: translate(-50%,-50%);"
                                     class="card-img">

                                    <h3 class="display-4" align="center">
                                        <a style="justify-content: center" class="btn btn-success" id="class-list-item"
                                           href=<?= $this->Url->build(['action' => 'displaystudent', $unit->id, $class->id, $peer_id]); ?>><?= $class->class_name ?></a>
                                    </h3>
                                </div>
                            <?php else: ?>
                                <h3>No class</h3>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h1>No class</h1>
                <?php endif; ?>
                <br>
            </div>
        </main>


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
