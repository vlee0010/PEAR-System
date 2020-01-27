<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Team'), ['action' => 'edit', $team->id_]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Team'), ['action' => 'delete', $team->id_], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id_)]) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Peer Reviews'), ['controller' => 'PeerReviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Peer Review'), ['controller' => 'PeerReviews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teams view large-9 medium-8 columns content">
    <h3><?= h($team->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($team->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $team->has('unit') ? $this->Html->link($team->unit->title, ['controller' => 'Units', 'action' => 'view', $team->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id ') ?></th>
            <td><?= $this->Number->format($team->id_) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Peer Reviews') ?></h4>
        <?php if (!empty($team->peer_reviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Date Start') ?></th>
                <th scope="col"><?= __('Date End') ?></th>
                <th scope="col"><?= __('Date Reminder') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Unit Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($team->peer_reviews as $peerReviews): ?>
            <tr>
                <td><?= h($peerReviews->id) ?></td>
                <td><?= h($peerReviews->date_start) ?></td>
                <td><?= h($peerReviews->date_end) ?></td>
                <td><?= h($peerReviews->date_reminder) ?></td>
                <td><?= h($peerReviews->title) ?></td>
                <td><?= h($peerReviews->unit_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PeerReviews', 'action' => 'view', $peerReviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PeerReviews', 'action' => 'edit', $peerReviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PeerReviews', 'action' => 'delete', $peerReviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peerReviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($team->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Verified') ?></th>
                <th scope="col"><?= __('Token') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($team->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->role) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->verified) ?></td>
                <td><?= h($users->token) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
