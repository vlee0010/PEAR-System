<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>

<table class="table">
    <tr>
        <th scope="row"><?= __('Description') ?></th>
        <td><?= h($question->description) ?></td>
    </tr>
</table>
<br><br><br><br><br>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        </ul>
    </nav>
    <div class="questions view large-9 medium-8 columns content">
        <h3><?= h($question->id) ?></h3>
        <table class="table table-borderless">
            <tr>
                <th scope="row"><?= __('Description') ?></th>
                <td><?= h($question->description) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Type') ?></th>
                <td><?= h($question->type) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($question->id) ?></td>
            </tr>
        </table>
    </div>

</div>
