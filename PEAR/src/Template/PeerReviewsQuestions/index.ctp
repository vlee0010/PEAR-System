<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PeerReviewsQuestion[]|\Cake\Collection\CollectionInterface $peerReviewsQuestions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Peer Reviews Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Peer Reviews'), ['controller' => 'PeerReviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Peer Review'), ['controller' => 'PeerReviews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="peerReviewsQuestions index large-9 medium-8 columns content">
    <h3><?= __('Peer Reviews Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('peer_reviews_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peerReviewsQuestions as $peerReviewsQuestion): ?>
            <tr>
                <td><?= $peerReviewsQuestion->has('peer_review') ? $this->Html->link($peerReviewsQuestion->peer_review->title, ['controller' => 'PeerReviews', 'action' => 'view', $peerReviewsQuestion->peer_review->id]) : '' ?></td>
                <td><?= $peerReviewsQuestion->has('question') ? $this->Html->link($peerReviewsQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $peerReviewsQuestion->question->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $peerReviewsQuestion->peer_reviews_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $peerReviewsQuestion->peer_reviews_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $peerReviewsQuestion->peer_reviews_id], ['confirm' => __('Are you sure you want to delete # {0}?', $peerReviewsQuestion->peer_reviews_id)]) ?>
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
