<html>
<body>
<?php

use Cake\View\Helper\FlashHelper;

$this->layout = 'default-staff';
?>
<?php $this->Breadcrumbs->templates([
    'wrapper' => '<nav aria-label="breadcrumb" role="navigation"><div class="breadcrumb">
                       
                        &nbsp;&nbsp;{{content}}</div></nav>',
    'item' => '<div class="breadcrumb-item" {{attrs}}><a href="{{url}}" {{innerAttrs}}> {{title}} </a> </div>{{separator}}',
    'itemWithoutLink' => '<div class="breadcrumb-item active" aria-current="page" {{attrs}}><span{{innerAttrs}}> <u>{{title}}</u></span></div>{{separator}}',
    'separator' => '<div{{attrs}}><span{{innerAttrs}}>{{separator}}</span></li>'
]) ?>
<?php $this->Breadcrumbs->add('All Units',['controller' => 'units', 'action' => 'index']) ?>
<?php $this->Breadcrumbs->add($unit->code.' '.$unit->title,['controller' => 'units', 'action' => 'view' ,$unit->id]) ?>
<?php $this->Breadcrumbs->add('Import Staff') ?>
<?= $this->Breadcrumbs->render(); ?>

<?php echo $this->Form->create('Admins', ['type' => 'file'], ['novalidate' => true]); ?>
<h1><?= h('Import CSV File') ?></h1>
<br>
<table class="table" width="100%">
    <thead></thead>
    <tbody>
    <tr>
        <h4>Select a file:</h4>
        <h5 class="data"><?php echo $this->Form->file('csvfilename', ['label' => '', 'size' => '30']); ?></h5>
    </tr>
</table>
<br/><br/>
<?= $this->Form->button(__('Cancel Import', true), ['name' => 'Cancel', 'div' => false, 'class' => 'delbutton btn btn-default']); ?>
<?= $this->Form->button(__('Import', true), ['name' => 'Import', 'div' => false, 'class' => 'delbutton btn btn-primary']); ?>
&nbsp;&nbsp;


<?= $this->Form->end() ?>
<br>
<?php
if (isset($successData)): ?>
    <table class="table" width="100%">
        <thead>
            <th>Id</th>
            <th>Staff ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Class</th>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($successData as $key => $value): ?>

                <td><?= $key+1?></td>
                <td><?= $successData[$key]['StaffId']?></td>
                <td><?= $successData[$key]['Firstname']?></td>
                <td><?= $successData[$key]['Lastname']?></td>
                <td><?= $successData[$key]['Email']?></td>
                <td><?= $successData[$key]['Class']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>


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


<script>
    const unitTab = document.querySelector('#create-unit');
    unitTab.classList.add('active');

    // $(document).ready(function() {
    //     $("input[name='unitCode']").change(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });
</script>


