<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PeerReviewsQuestion $peerReviewsQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Peer Reviews Question'), ['action' => 'edit', $peerReviewsQuestion->peer_reviews_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Peer Reviews Question'), ['action' => 'delete', $peerReviewsQuestion->peer_reviews_id], ['confirm' => __('Are you sure you want to delete # {0}?', $peerReviewsQuestion->peer_reviews_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Peer Reviews Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Peer Reviews Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Peer Reviews'), ['controller' => 'PeerReviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Peer Review'), ['controller' => 'PeerReviews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="peerReviewsQuestions view large-9 medium-8 columns content">
    <h3><?= h($peerReviewsQuestion->peer_reviews_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Peer Review') ?></th>
            <td><?= $peerReviewsQuestion->has('peer_review') ? $this->Html->link($peerReviewsQuestion->peer_review->title, ['controller' => 'PeerReviews', 'action' => 'view', $peerReviewsQuestion->peer_review->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $peerReviewsQuestion->has('question') ? $this->Html->link($peerReviewsQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $peerReviewsQuestion->question->id]) : '' ?></td>
        </tr>
    </table>
</div>
