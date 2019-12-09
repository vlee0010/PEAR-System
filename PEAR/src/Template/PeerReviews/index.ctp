<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PeerReview[]|\Cake\Collection\CollectionInterface $peerReviews
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Peer Review'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="peerReviews index large-9 medium-8 columns content">
    <h3><?= __('Peer Reviews') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_end') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_reminder') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peerReviews as $peerReview): ?>
            <tr>
                <td><?= $this->Number->format($peerReview->id) ?></td>
                <td><?= h($peerReview->date_start) ?></td>
                <td><?= h($peerReview->date_end) ?></td>
                <td><?= h($peerReview->date_reminder) ?></td>
                <td><?= h($peerReview->title) ?></td>
                <td><?= $peerReview->has('unit') ? $this->Html->link($peerReview->unit->title, ['controller' => 'Units', 'action' => 'view', $peerReview->unit->id]) : '' ?></td>
                <td><?= $this->Number->format($peerReview->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $peerReview->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $peerReview->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $peerReview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peerReview->id)]) ?>
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
