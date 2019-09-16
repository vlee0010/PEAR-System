<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="container">
<div class="card shadow">
    <h2 class="text-on-back" style="font-size:50px">Questions</h2>
    <table class="table table-flush" cellpadding="0" cellspacing="0" >
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Question 1 - Do you like your team members?
                                    <i class="fa fa-plus-circle pull-right"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="wrapper">
                                    <div class="toggle_radio">
                                        <input type="radio" class="toggle_option" id="first_toggle" name="toggle_option">
                                        <input type="radio" class="toggle_option" id="second_toggle" name="toggle_option">
                                        <input type="radio" checked class="toggle_option" id="third_toggle" name="toggle_option">
                                        <input type="radio" class="toggle_option" id="fourth_toggle" name="toggle_option">
                                        <input type="radio" class="toggle_option" id="fifth_toggle" name="toggle_option">
                                        <label for="first_toggle"><p>Very Unlikely</p></label>
                                        <label for="second_toggle"><p>Unlikely</p></label>
                                        <label for="third_toggle"><p>Neutral</p></label>
                                        <label for="fourth_toggle"><p>Likely</p></label>
                                        <label for="fifth_toggle_toggle"><p>Very Likely</p></label>
                                        <div class="toggle_option_slider">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</div>
