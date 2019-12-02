<html>
<body>
<?php
if(isset($success))
{ echo $success;}
$this->layout = 'default-staff';
?>
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
<?= $this->Form->button(__('Import', true), ['name' => 'Import', 'div' => false, 'class' => 'delbutton btn btn-warning']); ?>
&nbsp;&nbsp;


<?= $this->Form->end() ?>

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


