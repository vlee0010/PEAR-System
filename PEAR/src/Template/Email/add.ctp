<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email $email
 */
$this->setLayout('default-staff')
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Email'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="email form large-9 medium-8 columns content">
    <?= $this->Form->create($email) ?>
    <fieldset>
        <legend><?= __('Add Email') ?></legend>
        <?php
            echo $this->Form->control('unit_id', ['options' => $units, 'empty' => true]);
            echo $this->Form->control('sender');
            echo $this->Form->control('header');
            echo $this->Form->control('emailSubject');
            echo $this->Form->control('message');
            echo $this->Form->control('fromSender');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
