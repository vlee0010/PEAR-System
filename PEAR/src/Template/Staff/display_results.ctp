
<?php
/**
 * @var \App\View\AppView $this
 */
$this->layout=false;
?>


<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->meta('icon') ?>


    <?= $this->Html->css('nucleo-icons.css') ?>
    <?= $this->Html->css('blk-design-system.css') ?>
    <?= $this->Html->css('staff.css')?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="canonical" href="https://www.creative-tim.com/product/blk-design-system">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <style>
        .table>tbody>tr>td,
        .table>thead>tr>th{
            color:black !important;
        }
    </style>
</head>
<body>

<body>
<div class="container">
    <h1 align="center">Question Results</h1>
    <div align="right">

    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Question</th>
            <th>Ratee</th>
            <th>Answer</th>
        </tr>

        </thead>
        <tbody>
        <?php foreach ($response_list as $item) :?>
            <tr>
                <td><?=$item->question->description?></td>
                <td><?=$item->user->firstname." ".$item->user->lastname?></td>
                <?php if($item->is_text_number):?>
                    <td><?=$item->rate_text?></td>
                <?php else:?>
                    <td><?=$item->rate_number?></td>
                <?php endif;?>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

</body>
