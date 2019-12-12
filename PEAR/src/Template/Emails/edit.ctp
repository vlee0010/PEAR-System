<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email $email
 */
$this->layout = 'default-staff';
?>
<head>
    <script src="https://cdn.tiny.cloud/1/3fqsyet5f15rpx9ndtx1cvfssdbibwhgg97q79qsltnlngcj/tinymce/5/tinymce.min.js"></script>
    <script src="/team123-app/PEAR/webroot/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'advlist autolink link image lists charmap preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table directionality emoticons template paste'
            ],
            menubar: 'file edit view tools',
            toolbar: 'insertfile undo redo | styleselect fontselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  preview media fullpage | backcolor emoticons'
        });
    </script>
</head>

<div class="email form large-9 medium-8 columns content">
    <h1><?= __('Customize Email') ?></h1>
    <br>
    <?= $this->Form->create($email) ?>
    <fieldset>

        <form>
            <div class="form-group">
                <label for="input4_<?=$email->id?>">Header</label>
                <?= $this->Form->control('header',['class'=>'form-control', 'id' => 'input3_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="input4_<?=$email->id?>">Subject</label>
                <?= $this->Form->control('emailSubject',['class'=>'form-control', 'id' => 'input4_'.$email->id,'label' => '']);?>
            </div>
            <div class="form-group">
                <label for="mytextarea">Body</label>
                <?= $this->Form->control('message',['class'=>'form-control','type' => 'textarea','rows' => 18, 'id' => 'mytextarea','label' => '']);?>
            </div>
    </fieldset>
    <?= $this->Html->link('Cancel',['controller' => 'units', 'action' => 'view' ,$unit_id],['class' =>'btn btn-default','escape'=>true]) ?>
    <?= $this->Form->button(__('Save'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
