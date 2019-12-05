<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit[]|\Cake\Collection\CollectionInterface $units
 */
$this->layout = 'default-staff';
//$this->layout = false;

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css">

<div >
    <h1><?= __('Offerings') ?></h1>
    <table  class="table">
        <thead align="left">
            <tr>
                <th><?= $this->Paginator->sort('code') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('semester') ?></th>
                <th align="center"><?= $this->Paginator->sort('year') ?></th>
                <th class="actions" align="center"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($units as $unit): ?>
            <tr>
                <td><?= h($unit->code) ?></td>
                <td><?= h($unit->title) ?></td>
                <td><?= h($unit->semester) ?></td>
                <td><?= h($unit->year) ?></td>
                <td class="actions" style="text-align=center">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $unit->id]) ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p align="right"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>

<script>
    const unitTab = document.querySelector('#create-unit');
    unitTab.classList.add('active');

    // $(document).ready(function() {
    //     $("input[name='unitCode']").change(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // });
</script>

