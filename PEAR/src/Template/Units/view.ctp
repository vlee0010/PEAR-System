<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
$this->layout = 'default-staff';
?>

<div class="units view large-9 medium-8 columns content">
    <h1><?= h($unit->code.' '. $unit->title.' Semester '.$unit->semester.' '. $unit->year) ?></h1>
    <?php $urlImport = ['controller' => 'admins','action' => 'import',$unit->id];
    echo $this->Form->button('Import CSV', ['onclick' => "location.href='".$this->Url->build($urlImport)."'", 'class'=>'delbutton btn btn-default']);?>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($unit->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($unit->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semester') ?></th>
            <td><?= h($unit->semester) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= h($unit->year) ?></td>
        </tr>

    </table>
</div>
