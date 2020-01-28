<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>



<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table id="myTable"class="table table-flush" cellpadding="0" cellspacing="0">
        <thead>
        <tr>

            <th scope="col"><?= $this->Paginator->sort('first Name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('last Name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>


            <th scope="col"><?= $this->Paginator->sort('role') ?></th>

            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>


                <td><?= h($user->firstname) ?></td>
                <td><?= h($user->lastname) ?></td>
                <td><?= h($user->email) ?></td>
                <td>
                    <?php  if ($user->role == 1)echo 'Student';
                        elseif ($user->role == 2)echo 'Staff';
                        elseif ($user->role == 3)echo 'admin';
                ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller'=>'admins','action' => 'changeUserInfo', $user->id]) ?>

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


<script>
    const userTab = document.querySelector('#viewUsers');
    userTab.classList.add('active');
    const user = document.querySelector('#add-user');
    user.classList.add('show');
    const userExpand = document.querySelector('#userExpand');
    const users = document.querySelector('#user');
    users.classList.add('active');

    userExpand.classList.add('show');
</script>
