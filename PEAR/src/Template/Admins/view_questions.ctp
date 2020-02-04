<?php
//$this->layout=  false;
$this->layout = 'default-staff';
?>

<h2>View Questions</h2>

<table id="myTable"class="table table-flush" cellpadding="0" cellspacing="0">
    <thead>
    <tr>

        <th scope="col"><?= $this->Paginator->sort('Question Description') ?></th>






        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($questionsShow as $question): ?>
        <tr>


            <td><?= h($question->description) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('Delete'), ['controller'=>'admins','action' => 'hideQuestion', $question->id]) ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    const questionTab = document.querySelector('#question-tab');
    questionTab.classList.add('active');

    const questionExpand = document.querySelector('#questionExpand');

    questionExpand.classList.add('show');
    const vQ = document.querySelector('#vq');
    vQ.classList.add('active');
</script>
