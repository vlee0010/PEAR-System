<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PeerReview $peerReview
 */
?>

<?php
$this->layout = 'default-staff';
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $peerReview->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $peerReview->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Peer Reviews'), ['action' => 'index']) ?></li>
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
<div class="peerReviews form large-9 medium-8 columns content">
    <?= $this->Form->create($peerReview) ?>
    <fieldset>
        <legend><?= __('Edit Peer Review') ?></legend>
        <?php
            echo $this->Form->control('date_start');
            echo $this->Form->control('date_end');
            echo $this->Form->control('date_reminder');
            echo $this->Form->control('title');
            echo $this->Form->control('unit_id', ['options' => $units]);
            echo $this->Form->control('status');
            echo $this->Form->control('teams._ids', ['options' => $teams]);
            echo $this->Form->control('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
