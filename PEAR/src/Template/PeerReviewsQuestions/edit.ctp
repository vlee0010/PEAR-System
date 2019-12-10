<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PeerReviewsQuestion $peerReviewsQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $peerReviewsQuestion->peer_reviews_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $peerReviewsQuestion->peer_reviews_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Peer Reviews Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Peer Reviews'), ['controller' => 'PeerReviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Peer Review'), ['controller' => 'PeerReviews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="peerReviewsQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($peerReviewsQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Peer Reviews Question') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
