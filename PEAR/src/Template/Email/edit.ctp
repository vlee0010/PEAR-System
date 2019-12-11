<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email $email
 */
$this->setLayout('default-staff')
?>
<div class="email form large-9 medium-8 columns content">
    <h1><?= __('Customize Email') ?></h1>
    <?= $this->Form->create($email) ?>
    <fieldset>

        <form>
            <div class="form-group">
                <label for="input1_<?=$email->id?>">Sender</label>
                <?= $this->Form->control('sender',['class'=>'form-control', 'id' => 'input1_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="input2_<?=$email->id?>">From</label>
                <?= $this->Form->control('fromSender',['class'=>'form-control', 'id' => 'input2_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="input3_<?=$email->id?>">Header</label>
                <?= $this->Form->control('header',['class'=>'form-control', 'id' => 'input3_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="input4_<?=$email->id?>">Subject</label>
                <?= $this->Form->control('emailSubject',['class'=>'form-control', 'id' => 'input4_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="input5_<?=$email->id?>">Body</label>
                <?= $this->Form->control('message',['class'=>'form-control','type' => 'textarea','rows' => 8, 'id' => 'input5_'.$email->id,'label' => '']);?>
            </div>
    </fieldset>
    <?= $this->Form->button(__('Cancel', true), ['name' => 'Cancel', 'div' => false, 'class' => 'btn btn-default']); ?>
    <?= $this->Form->button(__('Save'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
