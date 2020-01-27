<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email $email
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Email'), ['action' => 'edit', $email->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Email'), ['action' => 'delete', $email->id], ['confirm' => __('Are you sure you want to delete # {0}?', $email->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Email'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Email'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="email view large-9 medium-8 columns content">
    <h3><?= h($email->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $email->has('unit') ? $this->Html->link($email->unit->title, ['controller' => 'Units', 'action' => 'view', $email->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender') ?></th>
            <td><?= h($email->sender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Header') ?></th>
            <td><?= h($email->header) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EmailSubject') ?></th>
            <td><?= h($email->emailSubject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($email->message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FromSender') ?></th>
            <td><?= h($email->fromSender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($email->id) ?></td>
        </tr>
    </table>
</div>
