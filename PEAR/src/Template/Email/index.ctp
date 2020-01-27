<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email[]|\Cake\Collection\CollectionInterface $email
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Email'), ['action' => 'add',2]) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="email index large-9 medium-8 columns content">
    <h3><?= __('Email') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender') ?></th>
                <th scope="col"><?= $this->Paginator->sort('header') ?></th>
                <th scope="col"><?= $this->Paginator->sort('emailSubject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fromSender') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($email as $email): ?>
            <tr>
                <td><?= $this->Number->format($email->id) ?></td>
                <td><?= $email->has('unit') ? $this->Html->link($email->unit->title, ['controller' => 'Units', 'action' => 'view', $email->unit->id]) : '' ?></td>
                <td><?= h($email->sender) ?></td>
                <td><?= h($email->header) ?></td>
                <td><?= h($email->emailSubject) ?></td>
                <td><?= h($email->message) ?></td>
                <td><?= h($email->fromSender) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $email->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $email->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $email->id], ['confirm' => __('Are you sure you want to delete # {0}?', $email->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
